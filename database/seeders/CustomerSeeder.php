<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('customers')->insert([
            [
                'nama' => 'Dewi Anggraini',
                'email' => 'dewi.anggraini@gmail.com',
                'telepon' => '081298765001',
                'perusahaan' => 'PT Rumah Indah',
                'jabatan' => 'Interior Designer',
                'alamat' => 'Jl. Sudirman No. 45',
                'kota' => 'Jakarta Selatan',
                'provinsi' => 'DKI Jakarta',
                'kode_pos' => '12190',
                'status_loyalitas' => 'vip',
                'catatan' => 'Pelanggan loyal, sudah 5x order furniture kayu jati.',
                'created_at' => now()->subMonths(6),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Ahmad Fauzi',
                'email' => 'ahmad.fauzi@yahoo.com',
                'telepon' => '085712345002',
                'perusahaan' => null,
                'jabatan' => null,
                'alamat' => 'Jl. Raya Bogor KM 30',
                'kota' => 'Depok',
                'provinsi' => 'Jawa Barat',
                'kode_pos' => '16416',
                'status_loyalitas' => 'reguler',
                'catatan' => 'Sering memesan meja dan kursi untuk rumah makan.',
                'created_at' => now()->subMonths(4),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Rina Marlina',
                'email' => 'rina.marlina@outlook.com',
                'telepon' => '087812345003',
                'perusahaan' => 'Villa Puncak Indah',
                'jabatan' => 'Owner',
                'alamat' => 'Jl. Raya Puncak No. 88',
                'kota' => 'Bogor',
                'provinsi' => 'Jawa Barat',
                'kode_pos' => '16750',
                'status_loyalitas' => 'vip',
                'catatan' => 'Order besar untuk villa dan resort. Perlu penanganan khusus.',
                'created_at' => now()->subMonths(3),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Hendro Wijaya',
                'email' => 'hendro.w@gmail.com',
                'telepon' => '081387654004',
                'perusahaan' => null,
                'jabatan' => null,
                'alamat' => 'Jl. Diponegoro No. 12',
                'kota' => 'Bandung',
                'provinsi' => 'Jawa Barat',
                'kode_pos' => '40115',
                'status_loyalitas' => 'baru',
                'catatan' => 'Baru pertama kali pesan. Tertarik dengan lemari kayu jati.',
                'created_at' => now()->subWeeks(2),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Siti Nurhaliza',
                'email' => 'siti.nurhaliza@gmail.com',
                'telepon' => '089612345005',
                'perusahaan' => 'Kafe Nusantara',
                'jabatan' => 'Manager',
                'alamat' => 'Jl. Malioboro No. 56',
                'kota' => 'Yogyakarta',
                'provinsi' => 'DI Yogyakarta',
                'kode_pos' => '55271',
                'status_loyalitas' => 'reguler',
                'catatan' => 'Order untuk interior kafe. Suka desain rustic.',
                'created_at' => now()->subMonths(2),
                'updated_at' => now(),
            ],
        ]);
    }
}
