<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WoodTypeSeeder extends Seeder
{
    public function run(): void
    {
        $woodTypes = [
            ['nama' => 'Kayu Jati', 'kode_warna' => '#8B6914', 'negara_asal' => 'Indonesia'],
            ['nama' => 'Kayu Mindi', 'kode_warna' => '#C4A35A', 'negara_asal' => 'Indonesia'],
            ['nama' => 'Kayu Kembang', 'kode_warna' => '#A0522D', 'negara_asal' => 'Indonesia'],
        ];

        foreach ($woodTypes as $wood) {
            DB::table('wood_types')->insert([
                'nama' => $wood['nama'],
                'kode_warna' => $wood['kode_warna'],
                'deskripsi' => null,
                'negara_asal' => $wood['negara_asal'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
