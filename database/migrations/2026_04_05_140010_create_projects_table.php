<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->foreignId('customer_id')->constrained('customers')->onDelete('restrict');
            $table->foreignId('order_id')->nullable()->constrained('orders')->onDelete('set null');
            $table->enum('jenis', ['komisi_kustom', 'produksi_stok', 'restorasi', 'renovasi']);
            $table->text('deskripsi')->nullable();
            $table->enum('prioritas', ['standar', 'tinggi', 'mendesak'])->default('standar');
            $table->decimal('anggaran', 15, 2)->nullable();
            $table->date('tanggal_mulai')->nullable();
            $table->date('target_selesai')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->integer('progress')->default(0);
            $table->enum('status', ['perencanaan', 'aktif', 'ditunda', 'selesai', 'dibatalkan'])->default('perencanaan');
            $table->json('material_terpilih')->nullable();
            $table->text('kebutuhan_khusus')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index('customer_id');
            $table->index('order_id');
            $table->index('status');
            $table->index('prioritas');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
