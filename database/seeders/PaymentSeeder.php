<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentSeeder extends Seeder
{
    public function run(): void
    {
        // Pembayaran DP order 1 (Dewi — Dalam Produksi)
        DB::table('payments')->insert([
            'order_id' => 1,
            'tanggal_bayar' => now()->subDays(9),
            'jumlah' => 5500000,
            'metode' => 'transfer_bank',
            'bukti_bayar' => null,
            'catatan' => 'DP 50% via BCA',
            'created_at' => now()->subDays(9),
            'updated_at' => now(),
        ]);

        // Pembayaran lunas order 2 (Ahmad — Dikirim)
        DB::table('payments')->insert([
            [
                'order_id' => 2,
                'tanggal_bayar' => now()->subDays(19),
                'jumlah' => 2650000,
                'metode' => 'transfer_bank',
                'bukti_bayar' => null,
                'catatan' => 'DP 50% via Mandiri',
                'created_at' => now()->subDays(19),
                'updated_at' => now(),
            ],
            [
                'order_id' => 2,
                'tanggal_bayar' => now()->subDays(5),
                'jumlah' => 2650000,
                'metode' => 'transfer_bank',
                'bukti_bayar' => null,
                'catatan' => 'Pelunasan via Mandiri',
                'created_at' => now()->subDays(5),
                'updated_at' => now(),
            ],
        ]);

        // Pembayaran lunas order 3 (Rina — Selesai)
        DB::table('payments')->insert([
            [
                'order_id' => 3,
                'tanggal_bayar' => now()->subDays(44),
                'jumlah' => 4500000,
                'metode' => 'transfer_bank',
                'bukti_bayar' => null,
                'catatan' => 'DP 50% via BRI',
                'created_at' => now()->subDays(44),
                'updated_at' => now(),
            ],
            [
                'order_id' => 3,
                'tanggal_bayar' => now()->subDays(10),
                'jumlah' => 4500000,
                'metode' => 'transfer_bank',
                'bukti_bayar' => null,
                'catatan' => 'Pelunasan via BRI saat pengiriman',
                'created_at' => now()->subDays(10),
                'updated_at' => now(),
            ],
        ]);

        // Pembayaran DP order 5 (Siti — Dalam Produksi)
        DB::table('payments')->insert([
            'order_id' => 5,
            'tanggal_bayar' => now()->subDays(6),
            'jumlah' => 4000000,
            'metode' => 'transfer_bank',
            'bukti_bayar' => null,
            'catatan' => 'DP 50% via BNI',
            'created_at' => now()->subDays(6),
            'updated_at' => now(),
        ]);
    }
}
