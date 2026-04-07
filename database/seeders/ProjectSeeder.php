<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        // Project 1 — Dewi (order 1) — Dalam Produksi
        DB::table('projects')->insert([
            'nomor_faktur' => 'PRJ-0001',
            'nama' => 'Set Kamar Tidur Kayu Jati',
            'customer_id' => 1,
            'order_id' => 1,
            'jenis' => 'komisi_kustom',
            'deskripsi' => 'Pembuatan lemari pakaian dan dipan kayu jati ukuran king size untuk rumah pelanggan di Jakarta.',
            'prioritas' => 'tinggi',
            'anggaran' => 11000000,
            'tanggal_mulai' => now()->subDays(8),
            'target_selesai' => now()->addDays(20),
            'progress' => 45,
            'status' => 'aktif',
            'kebutuhan_khusus' => 'Finishing harus extra halus, kayu jati pilihan grade A',
            'jenis_kayu_id' => 1,
            'finishing' => 'Natural Oak',
            'panjang' => 200,
            'lebar' => 180,
            'tinggi' => 200,
            'berat' => 120,
            'created_at' => now()->subDays(8),
            'updated_at' => now(),
        ]);

        // Milestones untuk project 1
        DB::table('project_milestones')->insert([
            ['project_id' => 1, 'nama' => 'Desain & Perencanaan', 'icon' => 'design_services', 'urutan' => 1, 'status' => 'selesai', 'tanggal_target' => now()->subDays(6), 'tanggal_selesai' => now()->subDays(7), 'catatan' => 'Desain disetujui klien', 'created_at' => now(), 'updated_at' => now()],
            ['project_id' => 1, 'nama' => 'Pemotongan Kayu', 'icon' => 'carpenter', 'urutan' => 2, 'status' => 'selesai', 'tanggal_target' => now()->subDays(3), 'tanggal_selesai' => now()->subDays(4), 'catatan' => null, 'created_at' => now(), 'updated_at' => now()],
            ['project_id' => 1, 'nama' => 'Perakitan', 'icon' => 'construction', 'urutan' => 3, 'status' => 'aktif', 'tanggal_target' => now()->addDays(5), 'tanggal_selesai' => null, 'catatan' => 'Sedang dikerjakan', 'created_at' => now(), 'updated_at' => now()],
            ['project_id' => 1, 'nama' => 'Finishing & Vernish', 'icon' => 'format_paint', 'urutan' => 4, 'status' => 'pending', 'tanggal_target' => now()->addDays(12), 'tanggal_selesai' => null, 'catatan' => null, 'created_at' => now(), 'updated_at' => now()],
            ['project_id' => 1, 'nama' => 'QC & Pengiriman', 'icon' => 'local_shipping', 'urutan' => 5, 'status' => 'pending', 'tanggal_target' => now()->addDays(18), 'tanggal_selesai' => null, 'catatan' => null, 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('project_members')->insert([
            ['project_id' => 1, 'user_id' => 1, 'peran' => 'Manager Proyek', 'created_at' => now(), 'updated_at' => now()],
            ['project_id' => 1, 'user_id' => 2, 'peran' => 'Tukang Kayu', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Project 2 — Siti (order 5) — Interior Kafe
        DB::table('projects')->insert([
            'nomor_faktur' => 'PRJ-0002',
            'nama' => 'Interior Kafe Nusantara',
            'customer_id' => 5,
            'order_id' => 5,
            'jenis' => 'produksi_stok',
            'deskripsi' => 'Pembuatan set meja makan ranting dan bangku kayu bulat untuk interior kafe bergaya rustic.',
            'prioritas' => 'standar',
            'anggaran' => 8000000,
            'tanggal_mulai' => now()->subDays(5),
            'target_selesai' => now()->addDays(25),
            'progress' => 20,
            'status' => 'aktif',
            'kebutuhan_khusus' => 'Gaya rustic, finishing glossy pada bangku',
            'jenis_kayu_id' => 1,
            'finishing' => 'Glossy',
            'panjang' => 150,
            'lebar' => 80,
            'tinggi' => 75,
            'berat' => 60,
            'created_at' => now()->subDays(5),
            'updated_at' => now(),
        ]);

        DB::table('project_milestones')->insert([
            ['project_id' => 2, 'nama' => 'Survei Lokasi', 'icon' => 'location_on', 'urutan' => 1, 'status' => 'selesai', 'tanggal_target' => now()->subDays(3), 'tanggal_selesai' => now()->subDays(4), 'catatan' => 'Selesai survei', 'created_at' => now(), 'updated_at' => now()],
            ['project_id' => 2, 'nama' => 'Pengerjaan Meja', 'icon' => 'table_bar', 'urutan' => 2, 'status' => 'aktif', 'tanggal_target' => now()->addDays(10), 'tanggal_selesai' => null, 'catatan' => 'Mulai dikerjakan', 'created_at' => now(), 'updated_at' => now()],
            ['project_id' => 2, 'nama' => 'Pengerjaan Bangku', 'icon' => 'chair', 'urutan' => 3, 'status' => 'pending', 'tanggal_target' => now()->addDays(15), 'tanggal_selesai' => null, 'catatan' => null, 'created_at' => now(), 'updated_at' => now()],
            ['project_id' => 2, 'nama' => 'Instalasi', 'icon' => 'handyman', 'urutan' => 4, 'status' => 'pending', 'tanggal_target' => now()->addDays(23), 'tanggal_selesai' => null, 'catatan' => null, 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('project_members')->insert([
            ['project_id' => 2, 'user_id' => 2, 'peran' => 'Kepala Produksi', 'created_at' => now(), 'updated_at' => now()],
            ['project_id' => 2, 'user_id' => 3, 'peran' => 'Koordinator Klien', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Project 3 — Rina (order 3) — Selesai
        DB::table('projects')->insert([
            'nomor_faktur' => 'PRJ-0003',
            'nama' => 'Gazebo & Ayunan Villa Puncak',
            'customer_id' => 3,
            'order_id' => 3,
            'jenis' => 'restorasi',
            'deskripsi' => 'Pembuatan gazebo extra besar dan 2 ayunan kayu jati untuk area outdoor Villa Puncak Indah.',
            'prioritas' => 'tinggi',
            'anggaran' => 9000000,
            'tanggal_mulai' => now()->subDays(40),
            'target_selesai' => now()->subDays(10),
            'tanggal_selesai' => now()->subDays(8),
            'progress' => 100,
            'status' => 'selesai',
            'kebutuhan_khusus' => 'Tahan cuaca outdoor, anti rayap',
            'rating' => 5,
            'keluhan_masukan' => 'Hasil sangat bagus dan rapi.',
            'jenis_kayu_id' => 1,
            'finishing' => 'Anti Rayap Outdoor Varnish',
            'panjang' => 300,
            'lebar' => 300,
            'tinggi' => 250,
            'berat' => 300,
            'created_at' => now()->subDays(40),
            'updated_at' => now()->subDays(8),
        ]);

        DB::table('project_milestones')->insert([
            ['project_id' => 3, 'nama' => 'Perencanaan', 'icon' => 'design_services', 'urutan' => 1, 'status' => 'selesai', 'tanggal_target' => now()->subDays(37), 'tanggal_selesai' => now()->subDays(38), 'catatan' => null, 'created_at' => now(), 'updated_at' => now()],
            ['project_id' => 3, 'nama' => 'Produksi', 'icon' => 'carpenter', 'urutan' => 2, 'status' => 'selesai', 'tanggal_target' => now()->subDays(20), 'tanggal_selesai' => now()->subDays(22), 'catatan' => null, 'created_at' => now(), 'updated_at' => now()],
            ['project_id' => 3, 'nama' => 'Pengiriman & Instalasi', 'icon' => 'local_shipping', 'urutan' => 3, 'status' => 'selesai', 'tanggal_target' => now()->subDays(10), 'tanggal_selesai' => now()->subDays(8), 'catatan' => 'Terpasang dengan baik', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Project 4 — Dewi (order 6) — Prospek (7 April 2026 - Selasa)
        DB::table('projects')->insert([
            'nomor_faktur' => 'PRJ-0004',
            'nama' => 'Lemari Pakaian Custom Dewi',
            'customer_id' => 1,
            'order_id' => 6,
            'jenis' => 'komisi_kustom',
            'deskripsi' => 'Pembuatan lemari pakaian custom dengan warna natural untuk pelanggan VIP.',
            'prioritas' => 'standar',
            'anggaran' => 6500000,
            'tanggal_mulai' => \Carbon\Carbon::create(2026, 4, 7),
            'target_selesai' => \Carbon\Carbon::create(2026, 4, 7)->addDays(14),
            'progress' => 0,
            'status' => 'aktif',
            'kebutuhan_khusus' => 'Finishing warna natural, bahan kayu jati grade A',
            'jenis_kayu_id' => 1,
            'finishing' => 'Natural',
            'panjang' => 180,
            'lebar' => 60,
            'tinggi' => 200,
            'berat' => 80,
            'created_at' => \Carbon\Carbon::create(2026, 4, 7),
            'updated_at' => now(),
        ]);

        DB::table('project_milestones')->insert([
            ['project_id' => 4, 'nama' => 'Desain & Perencanaan', 'icon' => 'design_services', 'urutan' => 1, 'status' => 'pending', 'tanggal_target' => \Carbon\Carbon::create(2026, 4, 7)->addDays(3), 'tanggal_selesai' => null, 'catatan' => null, 'created_at' => now(), 'updated_at' => now()],
            ['project_id' => 4, 'nama' => 'Pemotongan Kayu', 'icon' => 'carpenter', 'urutan' => 2, 'status' => 'pending', 'tanggal_target' => \Carbon\Carbon::create(2026, 4, 7)->addDays(6), 'tanggal_selesai' => null, 'catatan' => null, 'created_at' => now(), 'updated_at' => now()],
            ['project_id' => 4, 'nama' => 'Perakitan & Finishing', 'icon' => 'construction', 'urutan' => 3, 'status' => 'pending', 'tanggal_target' => \Carbon\Carbon::create(2026, 4, 7)->addDays(10), 'tanggal_selesai' => null, 'catatan' => null, 'created_at' => now(), 'updated_at' => now()],
            ['project_id' => 4, 'nama' => 'QC & Pengiriman', 'icon' => 'local_shipping', 'urutan' => 4, 'status' => 'pending', 'tanggal_target' => \Carbon\Carbon::create(2026, 4, 7)->addDays(14), 'tanggal_selesai' => null, 'catatan' => null, 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('project_members')->insert([
            ['project_id' => 4, 'user_id' => 1, 'peran' => 'Manager Proyek', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Project 5 — Ahmad (order 7) — Dalam Produksi (6 April 2026 - Senin)
        DB::table('projects')->insert([
            'nomor_faktur' => 'PRJ-0005',
            'nama' => 'Set Kursi Makan Ranting Ahmad',
            'customer_id' => 2,
            'order_id' => 7,
            'jenis' => 'komisi_kustom',
            'deskripsi' => 'Pembuatan 2 kursi makan bulat ranting custom untuk pelanggan reguler.',
            'prioritas' => 'tinggi',
            'anggaran' => 5600000,
            'tanggal_mulai' => \Carbon\Carbon::create(2026, 4, 6),
            'target_selesai' => \Carbon\Carbon::create(2026, 4, 6)->addDays(21),
            'progress' => 10,
            'status' => 'aktif',
            'kebutuhan_khusus' => 'Desain ranting artistik, finishing halus',
            'jenis_kayu_id' => 1,
            'finishing' => 'Natural Matte',
            'panjang' => 50,
            'lebar' => 50,
            'tinggi' => 90,
            'berat' => 45,
            'created_at' => \Carbon\Carbon::create(2026, 4, 6),
            'updated_at' => now(),
        ]);

        DB::table('project_milestones')->insert([
            ['project_id' => 5, 'nama' => 'Desain & Perencanaan', 'icon' => 'design_services', 'urutan' => 1, 'status' => 'selesai', 'tanggal_target' => \Carbon\Carbon::create(2026, 4, 6)->addDays(1), 'tanggal_selesai' => \Carbon\Carbon::create(2026, 4, 7), 'catatan' => 'Desain disetujui', 'created_at' => now(), 'updated_at' => now()],
            ['project_id' => 5, 'nama' => 'Pemotongan & Pembentukan Kayu', 'icon' => 'carpenter', 'urutan' => 2, 'status' => 'aktif', 'tanggal_target' => \Carbon\Carbon::create(2026, 4, 6)->addDays(7), 'tanggal_selesai' => null, 'catatan' => 'Sedang dikerjakan', 'created_at' => now(), 'updated_at' => now()],
            ['project_id' => 5, 'nama' => 'Perakitan', 'icon' => 'construction', 'urutan' => 3, 'status' => 'pending', 'tanggal_target' => \Carbon\Carbon::create(2026, 4, 6)->addDays(14), 'tanggal_selesai' => null, 'catatan' => null, 'created_at' => now(), 'updated_at' => now()],
            ['project_id' => 5, 'nama' => 'Finishing', 'icon' => 'format_paint', 'urutan' => 4, 'status' => 'pending', 'tanggal_target' => \Carbon\Carbon::create(2026, 4, 6)->addDays(18), 'tanggal_selesai' => null, 'catatan' => null, 'created_at' => now(), 'updated_at' => now()],
            ['project_id' => 5, 'nama' => 'QC & Pengiriman', 'icon' => 'local_shipping', 'urutan' => 5, 'status' => 'pending', 'tanggal_target' => \Carbon\Carbon::create(2026, 4, 6)->addDays(21), 'tanggal_selesai' => null, 'catatan' => null, 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('project_members')->insert([
            ['project_id' => 5, 'user_id' => 2, 'peran' => 'Tukang Kayu', 'created_at' => now(), 'updated_at' => now()],
            ['project_id' => 5, 'user_id' => 3, 'peran' => 'Koordinator Klien', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
