<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ProductsSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ["name" => "Pollo",                        "description" => "Pollo asado", "price" => 12, "image" => "storage/img/pollo.png"],
            ["name" => "Menu 20 de Enero del 2026",    "description" => "Menu 20",     "price" => 8,  "image" => "storage/img/menu20Enero2026.png"],
            ["name" => "Menu 02 de Diciembre del 2025","description" => "Menu 2",      "price" => 8,  "image" => "storage/img/menu2dic2025.png"],
            ["name" => "Menu 11 de Noviembre del 2025","description" => "Menu 11",     "price" => 8,  "image" => "storage/img/menu11Nov2025.png"],
            ["name" => "Menu 25 Noviembre del 2025",   "description" => "Menu 25",     "price" => 8,  "image" => "storage/img/menu25Nov2025.png"],
        ];

        foreach ($products as $product) {
            DB::table('products')->updateOrInsert(['name' => $product['name']], $product);
        }
    }
}
