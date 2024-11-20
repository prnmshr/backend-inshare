<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->uuid('notification_id')->primary();
            $table->uuid('user_id'); // Foreign key ke users
            $table->string('type'); // Tipe notifikasi (liked, commented, follow, etc)
            $table->text('message')->nullable(); // Pesan tambahan (jika ada)
            $table->string('media_url')->nullable(); // URL media yang terkait
            $table->boolean('is_new')->default(true); // Status baru/belum dilihat
            $table->timestamp('created_at')->useCurrent();
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
