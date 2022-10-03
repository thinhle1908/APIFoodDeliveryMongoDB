<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Category_ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category_product')->insert([
            'product_id'=>"1",
            'category_id'=>"1"

        ]);
        DB::table('category_product')->insert([
            'product_id'=>"1",
            'category_id'=>"2"

        ]);
        DB::table('category_product')->insert([
            'product_id'=>"2",
            'category_id'=>"2"

        ]);
        DB::table('category_product')->insert([
            'product_id'=>"3",
            'category_id'=>"3"

        ]);
        DB::table('category_product')->insert([
            'product_id'=>"4",
            'category_id'=>"4"

        ]);
        DB::table('category_product')->insert([
            'product_id'=>"5",
            'category_id'=>"5"

        ]);
    }
}
