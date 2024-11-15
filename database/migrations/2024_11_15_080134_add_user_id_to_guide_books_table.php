<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('guide_books', function (Blueprint $table) {
            // Tambahkan kolom user_id setelah kolom id
            $table->foreignId('user_id')
                  ->after('id')
                  ->constrained('users')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('guide_books', function (Blueprint $table) {
            // Hapus foreign key dan kolom saat rollback
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};