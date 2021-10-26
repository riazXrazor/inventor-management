<?php

use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductCategory::truncate();
        $d = ProductCategory::insert([
            [
                'category_name' => 'Cat 1'
            ],
            [
                'category_name' => 'Cat 2'
            ]
        ]);
    }
}
