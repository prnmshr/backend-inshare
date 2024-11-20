<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CommentSeeder extends Seeder
{
    public function run()
    {
        DB::table('comments')->insert([
            'post_id' => '1', // Assuming post_id 1 exists
            'user_id' => '1', // Assuming user_id 1 exists
            'comment' => 'Beautiful view!',
            'created_at' => now(),
        ]);
    }
}
