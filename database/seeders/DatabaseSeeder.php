<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
        DB::table('users')->insert([
            'username' => "admin",
            'firstname' => "admin",
            'lastname' => "admin",
            'email' => "admin@example.com",
            'password' => "$2y$10$"."vhoCvL2gKvVrEB.kYlSLueO3HQ0I6o212qv9r2S9urvGqArpEtEn6",
            'role' => "1",
            'permission' => "1"
        ]);

    }
}