<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVideoAndImageToGuideBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('guide_books', function (Blueprint $table) {
            $table->string('image_path')->nullable()->after('category');
            $table->string('video_path')->nullable()->after('image_path');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('guide_books', function (Blueprint $table) {
            $table->dropColumn('image_path');
            $table->dropColumn('video_path');
        });
    }
}