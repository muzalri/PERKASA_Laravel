<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class imagekomunitas extends Migration
{
    public function up()
    {
        Schema::table('komunitas', function (Blueprint $table) {
            $table->string('image', 255)->nullable(); // Menambahkan kolom 'image' dengan tipe VARCHAR(255)
        });
    }

    public function down()
    {
        Schema::table('komunitas', function (Blueprint $table) {
            $table->dropColumn('image'); // Menghapus kolom 'image' jika migrasi dibatalkan
        });
    }
}
