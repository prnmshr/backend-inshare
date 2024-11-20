<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoriesTable extends Migration
{
    public function up()
    {
        Schema::create('stories', function (Blueprint $table) {
            $table->increments('id'); // Kolom id sebagai auto increment
            $table->unsignedInteger('user_id'); // Kolom user_id sebagai foreign key
            $table->string('media_url'); // Kolom untuk menyimpan URL media story
            $table->timestamps();
            
            // Menambahkan foreign key untuk relasi ke tabel users
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('stories');
    }
}
