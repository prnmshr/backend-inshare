<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLikesTable extends Migration
{
    public function up()
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->increments('id'); // Kolom id sebagai auto increment
            $table->unsignedInteger('post_id'); // Kolom post_id sebagai foreign key
            $table->unsignedInteger('user_id'); // Kolom user_id sebagai foreign key
            $table->timestamps();
            
            // Menambahkan foreign key untuk relasi ke tabel posts dan users
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('likes');
    }
}
