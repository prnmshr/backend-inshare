<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id'); // Menandakan kolom id sebagai auto increment
            $table->unsignedInteger('post_id'); // Kolom post_id sebagai foreign key
            $table->unsignedInteger('user_id'); // Kolom user_id sebagai foreign key
            $table->text('comment');
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade'); // Foreign key untuk posts
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Foreign key untuk users
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
