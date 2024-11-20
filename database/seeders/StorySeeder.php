<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class StorySeeder extends Seeder
{
    public function run()
    {
        DB::table('stories')->insert([
            'user_id' => '1', // Assuming user_id 1 exists
            'media_url' => 'https://example.com/story.jpg',
            'created_at' => now(),
            'expiry_time' => now()->addDays(1),
        ]);
    }
}
