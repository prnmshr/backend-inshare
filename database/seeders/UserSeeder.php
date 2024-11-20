<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert(
            [
                'username' => 'pqrstfu',
                'name' => 'P',
                'password' => bcrypt('password123'),
                'email' => 'purnamaash@example.com',
                'phone' => '081234567890',
                'bio' => 'accidentally fall in love with code',
                'joined_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
