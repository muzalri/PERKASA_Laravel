<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin; // Pastikan model Admin di-import
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Buat admin dengan username 'admin' dan password '123456789'
        Admin::firstOrCreate([
            'username' => 'admin', // Username yang ingin dibuat
        ], [
            'password' => Hash::make('123456789'), // Hash password
        ]);
    }
} 