<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('komunitas_likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('komunitas_id')->constrained()->onDelete('cascade');
            $table->boolean('is_like');
            $table->timestamps();

            $table->unique(['user_id', 'komunitas_id']); // Satu user hanya bisa like/dislike sekali per artikel
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('komunitas_likes');
    }
};
