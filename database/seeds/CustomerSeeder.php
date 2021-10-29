<?php

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Customer::truncate();
        Customer::insert([
            [
                "name" => "james lo",
                "phone" => "0000000000"
            ],
            [
                "name" => "George roy",
                "phone" => "1111111111"
            ]
        ]);
    }
}
