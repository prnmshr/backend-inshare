<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('stories', function (Blueprint $table) {
            $table->uuid('story_id')->primary();
            $table->uuid('user_id'); // Foreign key ke users
            $table->string('media_url');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('expiry_time')->nullable();
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stories');
    }
};
