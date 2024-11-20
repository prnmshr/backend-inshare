<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    public function run()
    {
        DB::table('posts')->insert([
            'user_id' => '1',  // Assuming user_id 1 is a valid user
            'caption' => 'Enjoying the sunset!',
            'media_url' => 'https://example.com/sunset.jpg',
            'created_at' => now(),
            'tag' => 'sunset, photography',
        ]);
    }
}
