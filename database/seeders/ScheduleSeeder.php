<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ScheduleSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();
        $year = $now->year;
        $month = $now->month;

        $events = [
            [
                'judul' => 'Konsultasi Desain Kamar',
                'user_id' => 1,
                'customer_id' => 1,
                'project_id' => 1,
                'tipe' => 'pertemuan',
                'tanggal_mulai' => Carbon::create($year, $month, 5, 10, 0),
                'tanggal_selesai' => Carbon::create($year, $month, 5, 11, 0),
                'warna' => 'bg-blue-400',
                'catatan' => 'Bahas desain interior kamar tidur',
            ],
            [
                'judul' => 'Pengiriman Kayu Jati',
                'user_id' => 2,
                'customer_id' => null,
                'project_id' => null,
                'tipe' => 'pengiriman',
                'tanggal_mulai' => Carbon::create($year, $month, 8, 8, 0),
                'tanggal_selesai' => Carbon::create($year, $month, 8, 12, 0),
                'warna' => 'bg-emerald-400',
                'catatan' => 'Stok kayu jati grade A dari Jepara',
            ],
            [
                'judul' => 'Deadline Set Kamar Dewi',
                'user_id' => 1,
                'customer_id' => 1,
                'project_id' => 1,
                'tipe' => 'deadline',
                'tanggal_mulai' => Carbon::create($year, $month, 12, 17, 0),
                'tanggal_selesai' => Carbon::create($year, $month, 12, 17, 0),
                'warna' => 'bg-primary',
                'catatan' => 'Target finishing lemari & dipan',
            ],
            [
                'judul' => 'Pengambilan Set Gazebo Rina',
                'user_id' => 2,
                'customer_id' => 3,
                'project_id' => 3,
                'tipe' => 'pengambilan',
                'tanggal_mulai' => Carbon::create($year, $month, 12, 9, 0),
                'tanggal_selesai' => Carbon::create($year, $month, 12, 12, 0),
                'warna' => 'bg-amber-400',
                'catatan' => 'Pelanggan ambil di workshop',
            ],
            [
                'judul' => 'Perawatan Mesin Workshop',
                'user_id' => 2,
                'customer_id' => null,
                'project_id' => null,
                'tipe' => 'perawatan',
                'tanggal_mulai' => Carbon::create($year, $month, 15, 8, 0),
                'tanggal_selesai' => Carbon::create($year, $month, 15, 16, 0),
                'warna' => 'bg-orange-400',
                'catatan' => 'Service berkala alat potong & bor',
            ],
            [
                'judul' => 'Proposal Interior Siti',
                'user_id' => 3,
                'customer_id' => 5,
                'project_id' => 2,
                'tipe' => 'proposal',
                'tanggal_mulai' => Carbon::create($year, $month, 18, 13, 0),
                'tanggal_selesai' => Carbon::create($year, $month, 18, 14, 0),
                'warna' => 'bg-purple-400',
                'catatan' => 'Presentasi opsi tambahan untuk kafe',
            ],
            [
                'judul' => 'QC Meja Makan Ahmad',
                'user_id' => 2,
                'customer_id' => 2,
                'project_id' => null,
                'tipe' => 'pertemuan',
                'tanggal_mulai' => Carbon::create($year, $month, 20, 10, 0),
                'tanggal_selesai' => Carbon::create($year, $month, 20, 11, 0),
                'warna' => 'bg-blue-400',
                'catatan' => 'Quality check sebelum kirim',
            ],
            [
                'judul' => 'Pengiriman Order Siti',
                'user_id' => 2,
                'customer_id' => 5,
                'project_id' => 2,
                'tipe' => 'pengiriman',
                'tanggal_mulai' => Carbon::create($year, $month, 28, 7, 0),
                'tanggal_selesai' => Carbon::create($year, $month, 28, 15, 0),
                'warna' => 'bg-emerald-400',
                'catatan' => 'Kirim ke Yogyakarta',
            ],
            [
                'judul' => 'Review Keuangan Bulanan',
                'user_id' => 1,
                'customer_id' => null,
                'project_id' => null,
                'tipe' => 'deadline',
                'tanggal_mulai' => Carbon::create($year, $month, min(30, $now->daysInMonth), 16, 0),
                'tanggal_selesai' => Carbon::create($year, $month, min(30, $now->daysInMonth), 17, 0),
                'warna' => 'bg-surface-container-highest text-on-surface',
                'catatan' => 'Rekap laporan keuangan',
            ],
        ];

        foreach ($events as $event) {
            $event['created_at'] = now();
            $event['updated_at'] = now();
            DB::table('schedules')->insert($event);
        }
    }
}
