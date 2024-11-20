<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class NotificationSeeder extends Seeder
{
    public function run()
    {
        DB::table('notifications')->insert([
            'user_id' => '1', // Assuming user_id 1 exists
            'type' => 'Like',
            'time' => now(),
            'status' => 'unread',
        ]);
    }
}
