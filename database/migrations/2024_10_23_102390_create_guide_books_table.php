<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuideBooksTable extends Migration
{
    public function up()
    {
        Schema::create('guide_books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->foreignId('category_id')
                  ->references('id')
                  ->on('komunitas_categories')
                  ->onDelete('cascade');
            $table->string('image_path')->nullable();
            $table->string('video_path')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('guide_books');
    }
}
