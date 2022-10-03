<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorysSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'category_id'=>1,
            'category_name'=>"mon chien"

        ]);
        DB::table('categories')->insert([
             'category_id'=>12,
            'category_name'=>"mon xao"

        ]);
        DB::table('categories')->insert([
             'category_id'=>3,
            'category_name'=>"mon nuong"

        ]);
        DB::table('categories')->insert([
             'category_id'=>4,
            'category_name'=>"mon nuoc"

        ]);
        DB::table('categories')->insert([
             'category_id'=>5,
            'category_name'=>"tot cho suc khoe"

        ]);
        DB::table('categories')->insert([
             'category_id'=>6,
            'category_name'=>"trai cay"

        ]);
        DB::table('categories')->insert([
             'category_id'=>7,
            'category_name'=>"nuoc ep"

        ]);
        DB::table('categories')->insert([
             'category_id'=>8,
            'category_name'=>"keo"

        ]);
        DB::table('categories')->insert([
             'category_id'=>9,
            'category_name'=>"banh"

        ]);
        DB::table('categories')->insert([
             'category_id'=>10,
            'category_name'=>"nuoc"

        ]);
    }
}
