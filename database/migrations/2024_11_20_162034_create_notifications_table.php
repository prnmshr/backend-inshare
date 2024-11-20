<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->increments('id'); // Kolom id sebagai auto increment
            $table->unsignedInteger('user_id'); // Kolom user_id sebagai foreign key
            $table->string('message'); // Pesan notifikasi
            $table->enum('status', ['unread', 'read'])->default('unread'); // Status notifikasi
            $table->timestamps();
            
            // Menambahkan foreign key untuk relasi ke tabel users
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}
