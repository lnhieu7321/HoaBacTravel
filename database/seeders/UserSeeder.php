<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            "name" => "admin",
            "password" => Hash::make("admin123"),
            "email" => "lengochieu732001@gmail.com",
            "phone" => "0785406231",
            "role" => "admin",
            "statuses_id" => "1"
        ]);
    }
}
