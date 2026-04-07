<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class NotificationSeeder extends Seeder
{
    public function run(): void
    {
        $notifications = [
            // Hari ini — belum dibaca
            [
                'id' => Str::uuid()->toString(),
                'user_id' => 1,
                'tipe' => 'pesanan',
                'judul' => 'Status pesanan #INV-2024-001 diperbarui',
                'pesan' => 'Set Kamar Tidur Kayu Jati telah dipindahkan ke tahap "Perakitan".',
                'icon' => 'local_shipping',
                'url' => '/sales/1',
                'dibaca_pada' => null,
                'created_at' => now()->subHours(2),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid()->toString(),
                'user_id' => 1,
                'tipe' => 'pesan',
                'judul' => 'Pesan baru dari Dewi Anggraini',
                'pesan' => '"Hai, bisa kita diskusikan opsi finishing untuk lemari jati? Saya memikirkan tentang..."',
                'icon' => 'chat_bubble',
                'url' => '/clients/1',
                'dibaca_pada' => null,
                'created_at' => now()->subHours(3),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid()->toString(),
                'user_id' => 1,
                'tipe' => 'review',
                'judul' => 'Rina Marlina memberikan ulasan bintang 5',
                'pesan' => 'Gazebo dan Ayunan mendapat rating sempurna! "Keahlian luar biasa, sangat puas..."',
                'icon' => 'star',
                'url' => '/clients/3',
                'dibaca_pada' => null,
                'created_at' => now()->subHours(5),
                'updated_at' => now(),
            ],

            // Kemarin — sudah dibaca
            [
                'id' => Str::uuid()->toString(),
                'user_id' => 1,
                'tipe' => 'stok',
                'judul' => 'Peringatan stok menipis: Kayu Jati Grade A',
                'pesan' => 'Hanya tersisa 3 batang di inventaris. Pertimbangkan untuk segera mengisi ulang.',
                'icon' => 'inventory',
                'url' => '/products',
                'dibaca_pada' => now()->subHours(20),
                'created_at' => now()->subDay()->setHour(16)->setMinute(30),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid()->toString(),
                'user_id' => 1,
                'tipe' => 'pembayaran',
                'judul' => 'Pembayaran diterima — #INV-2024-002',
                'pesan' => 'Ahmad Fauzi melunasi Rp 2.650.000 untuk pesanan Meja Makan. Saldo: Rp 0',
                'icon' => 'payments',
                'url' => '/sales/2',
                'dibaca_pada' => now()->subHours(18),
                'created_at' => now()->subDay()->setHour(14)->setMinute(15),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid()->toString(),
                'user_id' => 1,
                'tipe' => 'pesanan',
                'judul' => 'Pengingat: Konsultasi klien besok',
                'pesan' => 'Pertemuan dengan Siti Nurhaliza pukul 10:00 — Diskusi Interior Kafe',
                'icon' => 'event',
                'url' => '/schedule',
                'dibaca_pada' => now()->subHours(15),
                'created_at' => now()->subDay()->setHour(9)->setMinute(0),
                'updated_at' => now(),
            ],

            // Awal minggu ini — sudah dibaca
            [
                'id' => Str::uuid()->toString(),
                'user_id' => 1,
                'tipe' => 'pesanan',
                'judul' => 'Proyek "Gazebo & Ayunan Villa" ditandai selesai',
                'pesan' => 'Semua milestone tercapai. Siap untuk pengiriman akhir.',
                'icon' => 'task_alt',
                'url' => '/projects/3/track',
                'dibaca_pada' => now()->subDays(2),
                'created_at' => now()->subDays(2),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid()->toString(),
                'user_id' => 1,
                'tipe' => 'pesan',
                'judul' => 'Pelanggan baru terdaftar: Hendro Wijaya',
                'pesan' => 'Tertarik dengan lemari kayu jati. Menunggu konsultasi.',
                'icon' => 'group_add',
                'url' => '/clients/4',
                'dibaca_pada' => now()->subDays(3),
                'created_at' => now()->subDays(3),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid()->toString(),
                'user_id' => 1,
                'tipe' => 'sistem',
                'judul' => 'Pemeliharaan sistem selesai',
                'pesan' => 'Semua sistem telah diperbarui. Tidak perlu tindakan.',
                'icon' => 'update',
                'url' => null,
                'dibaca_pada' => now()->subDays(4),
                'created_at' => now()->subDays(4),
                'updated_at' => now(),
            ],
        ];

        foreach ($notifications as $n) {
            DB::table('notifications')->insert($n);
        }
    }
}
