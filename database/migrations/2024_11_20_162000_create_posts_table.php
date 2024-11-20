<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id'); // Menandakan kolom id sebagai auto increment
            $table->string('caption');
            $table->string('media_url');
            $table->unsignedInteger('user_id'); // Kolom user_id sebagai foreign key
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Menambahkan foreign key
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
