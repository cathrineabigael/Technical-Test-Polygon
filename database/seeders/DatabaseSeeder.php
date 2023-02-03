<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        DB::table('categorys')->insert(
            [
                'name' => "gaji",
                'type' => "income",
            ],

        );
        DB::table('categorys')->insert(
            [
                'name' => "bonus",
                'type' => "income",
            ],

        );
        DB::table('categorys')->insert(
            [
                'name' => "makan & minum",
                'type' => "expense",
            ],

        );
        DB::table('categorys')->insert(
            [
                'name' => "tagihan",
                'type' => "expense",
            ],

        );
        DB::table('categorys')->insert(
            [
                'name' => "sedekah",
                'type' => "expense",
            ],

        );
        DB::table('categorys')->insert(
            [
                'name' => "transport",
                'type' => "expense",
            ],

        );
        
        DB::table('roles')->insert(
            [
                'name' => "user",
            ],

        );
        DB::table('roles')->insert(
            [
                'name' => "verificator",
            ],

        );
    }
}
