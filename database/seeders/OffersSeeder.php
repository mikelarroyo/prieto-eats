<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OffersSeeder extends Seeder
{
    public function run(): void
    {
        $tomorrow   = now()->addDay();
        $dayAfter   = now()->addDays(2);
        $threeDays  = now()->addDays(3);

        // Oferta 1 — mañana, límite de pedidos en 24 horas
        DB::table('offers')->insert([
            'date_delivery'  => $tomorrow->format('Y-m-d'),
            'time_delivery'  => '13:30',
            'datetime_limit' => now()->addDay()->format('Y-m-d H:i:s'),
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);

        // Oferta 2 — pasado mañana, sin límite de pedidos (siempre visible)
        DB::table('offers')->insert([
            'date_delivery'  => $dayAfter->format('Y-m-d'),
            'time_delivery'  => '14:00',
            'datetime_limit' => null,
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);

        // Oferta 3 — en 3 días, límite en 48 horas
        DB::table('offers')->insert([
            'date_delivery'  => $threeDays->format('Y-m-d'),
            'time_delivery'  => '13:00',
            'datetime_limit' => now()->addDays(2)->format('Y-m-d H:i:s'),
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);
    }
}
