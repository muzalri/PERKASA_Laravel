<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropRoleFromUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Menghapus kolom role
            $table->dropColumn('role');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Menambahkan kembali kolom role jika migrasi dibatalkan
            $table->enum('role', ['user', 'pakar', 'admin'])->default('user')->after('alamat');
        });
    }
}