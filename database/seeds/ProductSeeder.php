<?php

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::truncate();
        Product::insert([
            [
                "name" => "Product 1",
                "category_id" => ProductCategory::all()->random()->id,
                "price" => 1000.00,
                "stock" => 10
            ],
            [
                "name" => "Product 2",
                "category_id" => ProductCategory::all()->random()->id,
                "price" => 1000.00,
                "stock" => 10
            ]
        ]);
    }
}
