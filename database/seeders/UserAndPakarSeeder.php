<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserAndPakarSeeder extends Seeder
{
    public function run()
    {
        // Seeder untuk User
        DB::table('users')->insert([
            [
                'name' => 'Pengguna Biasa',
                'email' => 'anwar@gmail.com',
                'password' => Hash::make('12345678'),
                'no_hp' => '081234567890',
                'alamat' => 'Jl. Contoh No. 123, Kota Contoh',
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // ... tambahkan pengguna lain jika diperlukan ...
        ]);

        DB::table('users')->insert([
            [
                'name' => 'Pengguna Biasa Aja',
                'email' => 'cibe@gmail.com',
                'password' => Hash::make('12345678'),
                'no_hp' => '085817288710',
                'alamat' => 'Jl. Cisangkui No 6, Kota Bogor',
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // ... tambahkan pengguna lain jika diperlukan ...
        ]);

        // Seeder untuk Pakar
        DB::table('users')->insert([
            [
                'name' => 'Pakar Ahli',
                'email' => 'pakar@gmail.com',
                'password' => Hash::make('12345678'),
                'no_hp' => '087654321098',
                'alamat' => 'Jl. Pakar No. 456, Kota Pakar',
                'role' => 'pakar',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // ... tambahkan pakar lain jika diperlukan ...
        ]);
    }
}
