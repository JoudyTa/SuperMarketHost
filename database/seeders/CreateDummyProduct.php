<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class CreateDummyProduct extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $products = ['codechief.org', 'wordpress.org', 'laramust.com'];

        foreach ($products as $key => $value) {
            Product::create(['name' => $value]);
        }
    }
}