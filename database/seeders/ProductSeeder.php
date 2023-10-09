<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
           "name" => "Baju",
           "collections" => "summer",
           "price" => "200"
        ]);

        Product::create([
            "name" => "Celana",
            "collections" => "summer",
            "price" => "200"
         ]);

         Product::create([
            "name" => "Topi",
            "collections" => "rain",
            "price" => "200"
         ]);
    }
}
