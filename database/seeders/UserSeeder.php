<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin Mebel',
                'email' => 'admin@webmebel.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'jabatan' => 'Pemilik',
                'telepon' => '081234567890',
                'avatar' => null,
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Budi Santoso',
                'email' => 'budi@webmebel.com',
                'password' => Hash::make('password'),
                'role' => 'pengrajin',
                'jabatan' => 'Kepala Produksi',
                'telepon' => '081234567891',
                'avatar' => null,
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sari Dewi',
                'email' => 'sari@webmebel.com',
                'password' => Hash::make('password'),
                'role' => 'pengrajin',
                'jabatan' => 'Marketing',
                'telepon' => '081234567892',
                'avatar' => null,
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
