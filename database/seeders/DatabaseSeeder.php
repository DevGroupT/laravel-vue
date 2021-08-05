<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('countries')->insert([
            'country_code' => Str::random(3),
            'name' => Str::random(10)
        ]);

    }
}