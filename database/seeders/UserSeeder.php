<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// imfor facades DB
use Illuminate\Support\Facades\DB;
// imfor hash untuk enskripsi
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //kode ini untuk input data kedalam tabel user
        DB::table("users")->insert([
            "name"=> "admin",
            "email"=> "admin@gmail.com",
            "password"=> Hash::make("admin123"),
        ]);
    }
}
