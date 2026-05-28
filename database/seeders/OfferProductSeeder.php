<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OfferProductSeeder extends Seeder
{
    public function run(): void
    {
        if (DB::table('product_offers')->count() > 0) {
            return;
        }

        DB::table('product_offers')->insert([
            ['offer_id' => 1, 'product_id' => 1, 'price' => 12.00, 'created_at' => now(), 'updated_at' => now()],
            ['offer_id' => 1, 'product_id' => 2, 'price' => 8.00,  'created_at' => now(), 'updated_at' => now()],
            ['offer_id' => 2, 'product_id' => 3, 'price' => 7.50,  'created_at' => now(), 'updated_at' => now()],
            ['offer_id' => 2, 'product_id' => 4, 'price' => 7.50,  'created_at' => now(), 'updated_at' => now()],
            ['offer_id' => 3, 'product_id' => 1, 'price' => 11.00, 'created_at' => now(), 'updated_at' => now()],
            ['offer_id' => 3, 'product_id' => 5, 'price' => 7.00,  'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
