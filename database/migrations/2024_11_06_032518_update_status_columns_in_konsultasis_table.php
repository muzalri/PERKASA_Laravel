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
        Schema::table('konsultasis', function (Blueprint $table) {
            // Hapus kolom lama jika ada
            if (Schema::hasColumn('konsultasis', 'status_user')) {
                $table->dropColumn('status_user');
            }
            if (Schema::hasColumn('konsultasis', 'status_pakar')) {
                $table->dropColumn('status_pakar');
            }
    
            // Tambah kolom baru
            $table->enum('status_user', ['active', 'deleted'])->default('active');
            $table->enum('status_pakar', ['active', 'deleted'])->default('active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('konsultasis', function (Blueprint $table) {
            $table->dropColumn(['status_user', 'status_pakar']);
            $table->boolean('deleted_by_user')->default(false);
            $table->boolean('deleted_by_pakar')->default(false);
        });
    }
};
