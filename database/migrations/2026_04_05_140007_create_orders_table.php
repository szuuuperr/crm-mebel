<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_faktur', 30)->unique();
            $table->foreignId('customer_id')->constrained('customers')->onDelete('restrict');
            $table->foreignId('user_id')->constrained('users')->onDelete('restrict');
            $table->date('tanggal_pesanan');
            $table->decimal('subtotal', 15, 2)->default(0);
            $table->decimal('pajak_persen', 5, 2)->default(0);
            $table->decimal('pajak', 15, 2)->default(0);
            $table->decimal('ongkir', 15, 2)->default(0);
            $table->decimal('diskon', 15, 2)->default(0);
            $table->decimal('total', 15, 2)->default(0);
            $table->enum('status', ['prospek', 'dalam_produksi', 'dikirim', 'selesai', 'dibatalkan'])->default('prospek');
            $table->enum('prioritas', ['standar', 'cepat', 'express'])->default('standar');
            $table->enum('metode_pembayaran', ['transfer_bank', 'kartu_kredit', 'dp_pelunasan'])->nullable();
            $table->enum('status_pembayaran', ['belum_bayar', 'dp', 'lunas'])->default('belum_bayar');
            $table->date('estimasi_pengiriman')->nullable();
            $table->text('alamat_pengiriman')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index('customer_id');
            $table->index('status');
            $table->index('tanggal_pesanan');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
