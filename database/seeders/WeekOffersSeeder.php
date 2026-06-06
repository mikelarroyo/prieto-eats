<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WeekOffersSeeder extends Seeder
{
    public function run(): void
    {
        $today = Carbon::today();

        // Si es fin de semana usamos el lunes siguiente, si no el lunes de esta semana
        $monday = $today->isWeekend()
            ? Carbon::parse('next Monday')
            : $today->copy()->startOfWeek(Carbon::MONDAY);

        // Horarios diferentes para cada día
        $dias = [
            ['offset' => 0, 'time' => '13:30'],  // Lunes
            ['offset' => 1, 'time' => '14:00'],  // Martes
            ['offset' => 2, 'time' => '13:00'],  // Miércoles
            ['offset' => 3, 'time' => '14:30'],  // Jueves
            ['offset' => 4, 'time' => '13:30'],  // Viernes
        ];

        $productIds = DB::table('products')->pluck('id')->values()->toArray();

        if (empty($productIds)) {
            return;
        }

        $precios = [7.50, 8.00, 8.50, 9.00, 10.00, 11.00, 12.00];

        foreach ($dias as $i => $dia) {
            $fecha    = $monday->copy()->addDays($dia['offset']);
            $fechaStr = $fecha->format('Y-m-d');

            // Idempotente: si ya existe oferta para esa fecha, la saltamos
            if (DB::table('offers')->where('date_delivery', $fechaStr)->exists()) {
                continue;
            }

            // Límite de pedido: el día anterior a las 21:00
            $limite = $fecha->copy()->subDay()->setTime(21, 0, 0);

            $offerId = DB::table('offers')->insertGetId([
                'date_delivery'  => $fechaStr,
                'time_delivery'  => $dia['time'],
                'datetime_limit' => $limite->format('Y-m-d H:i:s'),
                'created_at'     => now(),
                'updated_at'     => now(),
            ]);

            // Asignamos 2 o 3 productos distintos rotando por el pool
            $numProductos = ($i % 2 === 0) ? 3 : 2;
            $inicio       = ($i * 2) % count($productIds);

            $rows = [];
            for ($j = 0; $j < $numProductos; $j++) {
                $rows[] = [
                    'offer_id'   => $offerId,
                    'product_id' => $productIds[($inicio + $j) % count($productIds)],
                    'price'      => $precios[($i + $j) % count($precios)],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            DB::table('product_offers')->insert($rows);
        }
    }
}
