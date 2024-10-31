<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToPesansTable extends Migration
{
    public function up()
    {
        Schema::table('pesans', function (Blueprint $table) {
            $table->enum('status', ['belum_dibaca', 'dibaca', 'dibalas'])->default('belum_dibaca');
        });
    }

    public function down()
    {
        Schema::table('pesans', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}