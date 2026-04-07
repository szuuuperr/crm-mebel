<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $products = DB::table('products')->pluck('id', 'nama_produk');

        // Order 1 — Dewi (customer 1) — Dalam Produksi
        DB::table('orders')->insert([
            'nomor_faktur' => 'INV-2024-001',
            'customer_id' => 1,
            'user_id' => 1,
            'tanggal_pesanan' => now()->subDays(10),
            'subtotal' => 10500000,
            'pajak_persen' => 0,
            'pajak' => 0,
            'ongkir' => 500000,
            'diskon' => 0,
            'total' => 11000000,
            'status' => 'dalam_produksi',
            'prioritas' => 'express',
            'metode_pembayaran' => 'transfer_bank',
            'status_pembayaran' => 'dp',
            'estimasi_pengiriman' => now()->addDays(20),
            'alamat_pengiriman' => 'Jl. Sudirman No. 45, Jakarta Selatan',
            'catatan' => 'Finishing harus extra halus',
            'created_at' => now()->subDays(10),
            'updated_at' => now(),
        ]);

        DB::table('order_items')->insert([
            ['order_id' => 1, 'product_id' => $products['Lemari pakaian'], 'jumlah' => 1, 'harga_satuan' => 6200000, 'subtotal' => 6200000, 'kustomisasi' => null, 'created_at' => now(), 'updated_at' => now()],
            ['order_id' => 1, 'product_id' => $products['Dipan kayu jati'], 'jumlah' => 1, 'harga_satuan' => 4300000, 'subtotal' => 4300000, 'kustomisasi' => 'Ukuran King Size', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Order 2 — Ahmad (customer 2) — Dikirim
        DB::table('orders')->insert([
            'nomor_faktur' => 'INV-2024-002',
            'customer_id' => 2,
            'user_id' => 1,
            'tanggal_pesanan' => now()->subDays(20),
            'subtotal' => 5000000,
            'pajak_persen' => 0,
            'pajak' => 0,
            'ongkir' => 300000,
            'diskon' => 0,
            'total' => 5300000,
            'status' => 'dikirim',
            'prioritas' => 'standar',
            'metode_pembayaran' => 'transfer_bank',
            'status_pembayaran' => 'lunas',
            'estimasi_pengiriman' => now()->addDays(3),
            'alamat_pengiriman' => 'Jl. Raya Bogor KM 30, Depok',
            'catatan' => null,
            'created_at' => now()->subDays(20),
            'updated_at' => now(),
        ]);

        DB::table('order_items')->insert([
            ['order_id' => 2, 'product_id' => $products['Meja makan'], 'jumlah' => 1, 'harga_satuan' => 2500000, 'subtotal' => 2500000, 'kustomisasi' => null, 'created_at' => now(), 'updated_at' => now()],
            ['order_id' => 2, 'product_id' => $products['Meja makan'], 'jumlah' => 1, 'harga_satuan' => 2500000, 'subtotal' => 2500000, 'kustomisasi' => 'Warna lebih gelap', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Order 3 — Rina (customer 3) — Selesai
        DB::table('orders')->insert([
            'nomor_faktur' => 'INV-2024-003',
            'customer_id' => 3,
            'user_id' => 2,
            'tanggal_pesanan' => now()->subDays(45),
            'subtotal' => 8700000,
            'pajak_persen' => 0,
            'pajak' => 0,
            'ongkir' => 800000,
            'diskon' => 500000,
            'total' => 9000000,
            'status' => 'selesai',
            'prioritas' => 'express',
            'metode_pembayaran' => 'transfer_bank',
            'status_pembayaran' => 'lunas',
            'estimasi_pengiriman' => now()->subDays(10),
            'alamat_pengiriman' => 'Jl. Raya Puncak No. 88, Bogor',
            'catatan' => 'Untuk villa, diantar pagi hari',
            'rating' => 5,
            'keluhan_masukan' => 'Sangat puas dengan gazebo dan ayunannya, terima kasih!',
            'created_at' => now()->subDays(45),
            'updated_at' => now()->subDays(5),
        ]);

        DB::table('order_items')->insert([
            ['order_id' => 3, 'product_id' => $products['Gazebo'], 'jumlah' => 1, 'harga_satuan' => 3500000, 'subtotal' => 3500000, 'kustomisasi' => 'Extra besar', 'created_at' => now(), 'updated_at' => now()],
            ['order_id' => 3, 'product_id' => $products['Ayunan 2 dudukan'], 'jumlah' => 2, 'harga_satuan' => 2500000, 'subtotal' => 5000000, 'kustomisasi' => null, 'created_at' => now(), 'updated_at' => now()],
            ['order_id' => 3, 'product_id' => $products['Rak sepatu'], 'jumlah' => 1, 'harga_satuan' => 1200000, 'subtotal' => 1200000, 'kustomisasi' => null, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Order 4 — Hendro (customer 4) — Prospek Baru
        DB::table('orders')->insert([
            'nomor_faktur' => 'INV-2024-004',
            'customer_id' => 4,
            'user_id' => 3,
            'tanggal_pesanan' => now()->subDays(2),
            'subtotal' => 1700000,
            'pajak_persen' => 0,
            'pajak' => 0,
            'ongkir' => 400000,
            'diskon' => 0,
            'total' => 2100000,
            'status' => 'prospek',
            'prioritas' => 'standar',
            'metode_pembayaran' => null,
            'status_pembayaran' => 'belum_bayar',
            'estimasi_pengiriman' => now()->addDays(30),
            'alamat_pengiriman' => 'Jl. Diponegoro No. 12, Bandung',
            'catatan' => 'Pelanggan minta cek kualitas dulu sebelum bayar',
            'created_at' => now()->subDays(2),
            'updated_at' => now(),
        ]);

        DB::table('order_items')->insert([
            ['order_id' => 4, 'product_id' => $products['Meja belajar'], 'jumlah' => 1, 'harga_satuan' => 1700000, 'subtotal' => 1700000, 'kustomisasi' => 'Warna cat natural', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Order 5 — Siti (customer 5) — Dalam Produksi
        DB::table('orders')->insert([
            'nomor_faktur' => 'INV-2024-005',
            'customer_id' => 5,
            'user_id' => 2,
            'tanggal_pesanan' => now()->subDays(7),
            'subtotal' => 7700000,
            'pajak_persen' => 0,
            'pajak' => 0,
            'ongkir' => 600000,
            'diskon' => 300000,
            'total' => 8000000,
            'status' => 'dalam_produksi',
            'prioritas' => 'standar',
            'metode_pembayaran' => 'transfer_bank',
            'status_pembayaran' => 'dp',
            'estimasi_pengiriman' => now()->addDays(25),
            'alamat_pengiriman' => 'Jl. Malioboro No. 56, Yogyakarta',
            'catatan' => 'Interior kafe rustic',
            'created_at' => now()->subDays(7),
            'updated_at' => now(),
        ]);

        DB::table('order_items')->insert([
            ['order_id' => 5, 'product_id' => $products['Meja makan ranting'], 'jumlah' => 2, 'harga_satuan' => 2200000, 'subtotal' => 4400000, 'kustomisasi' => null, 'created_at' => now(), 'updated_at' => now()],
            ['order_id' => 5, 'product_id' => $products['Bangku kayu bulat'], 'jumlah' => 2, 'harga_satuan' => 1300000, 'subtotal' => 2600000, 'kustomisasi' => 'Finishing glossy', 'created_at' => now(), 'updated_at' => now()],
            ['order_id' => 5, 'product_id' => $products['Rak ranting'], 'jumlah' => 1, 'harga_satuan' => 1300000, 'subtotal' => 1300000, 'kustomisasi' => null, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Order 6 — Dewi (customer 1) — Baru (7 April 2026 - Selasa)
        DB::table('orders')->insert([
            'nomor_faktur' => 'INV-2024-006',
            'customer_id' => 1,
            'user_id' => 1,
            'tanggal_pesanan' => \Carbon\Carbon::create(2026, 4, 7),
            'subtotal' => 6200000,
            'pajak_persen' => 0,
            'pajak' => 0,
            'ongkir' => 300000,
            'diskon' => 0,
            'total' => 6500000,
            'status' => 'prospek',
            'prioritas' => 'standar',
            'metode_pembayaran' => null,
            'status_pembayaran' => 'belum_bayar',
            'estimasi_pengiriman' => \Carbon\Carbon::create(2026, 4, 7)->addDays(14),
            'alamat_pengiriman' => 'Jl. Sudirman No. 45, Jakarta Selatan',
            'catatan' => 'Order tambahan untuk bulan April 2026',
            'created_at' => \Carbon\Carbon::create(2026, 4, 7),
            'updated_at' => now(),
        ]);

        DB::table('order_items')->insert([
            ['order_id' => 6, 'product_id' => $products['Lemari pakaian'], 'jumlah' => 1, 'harga_satuan' => 6200000, 'subtotal' => 6200000, 'kustomisasi' => 'Warna natural', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Order 7 — Ahmad (customer 2) — Dalam Produksi (6 April 2026 - Senin)
        DB::table('orders')->insert([
            'nomor_faktur' => 'INV-2024-007',
            'customer_id' => 2,
            'user_id' => 2,
            'tanggal_pesanan' => \Carbon\Carbon::create(2026, 4, 6),
            'subtotal' => 5400000,
            'pajak_persen' => 0,
            'pajak' => 0,
            'ongkir' => 400000,
            'diskon' => 200000,
            'total' => 5600000,
            'status' => 'dalam_produksi',
            'prioritas' => 'express',
            'metode_pembayaran' => 'transfer_bank',
            'status_pembayaran' => 'dp',
            'estimasi_pengiriman' => \Carbon\Carbon::create(2026, 4, 6)->addDays(21),
            'alamat_pengiriman' => 'Jl. Raya Bogor KM 30, Depok',
            'catatan' => 'Pesanan minggu April 2026',
            'created_at' => \Carbon\Carbon::create(2026, 4, 6),
            'updated_at' => now(),
        ]);

        DB::table('order_items')->insert([
            ['order_id' => 7, 'product_id' => $products['Kursi makan bulat ranting'], 'jumlah' => 2, 'harga_satuan' => 2700000, 'subtotal' => 5400000, 'kustomisasi' => null, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Order 8 — Hendro (customer 4) — Baru (8 April 2026 - Rabu)
        DB::table('orders')->insert([
            'nomor_faktur' => 'INV-2024-008',
            'customer_id' => 4,
            'user_id' => 3,
            'tanggal_pesanan' => \Carbon\Carbon::create(2026, 4, 8),
            'subtotal' => 3400000,
            'pajak_persen' => 0,
            'pajak' => 0,
            'ongkir' => 350000,
            'diskon' => 0,
            'total' => 3750000,
            'status' => 'prospek',
            'prioritas' => 'standar',
            'metode_pembayaran' => null,
            'status_pembayaran' => 'belum_bayar',
            'estimasi_pengiriman' => \Carbon\Carbon::create(2026, 4, 8)->addDays(18),
            'alamat_pengiriman' => 'Jl. Diponegoro No. 12, Bandung',
            'catatan' => 'Order baru minggu ini',
            'created_at' => \Carbon\Carbon::create(2026, 4, 8),
            'updated_at' => now(),
        ]);

        DB::table('order_items')->insert([
            ['order_id' => 8, 'product_id' => $products['Meja rias'], 'jumlah' => 1, 'harga_satuan' => 2500000, 'subtotal' => 2500000, 'kustomisasi' => null, 'created_at' => now(), 'updated_at' => now()],
            ['order_id' => 8, 'product_id' => $products['Stole'], 'jumlah' => 3, 'harga_satuan' => 300000, 'subtotal' => 900000, 'kustomisasi' => null, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
