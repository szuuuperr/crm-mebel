<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('nama_produk');
            $table->foreignId('kategori_id')->constrained('categories')->onDelete('restrict');
            $table->foreignId('jenis_kayu_id')->constrained('wood_types')->onDelete('restrict');
            $table->decimal('harga', 15, 2)->default(0);
            $table->text('deskripsi')->nullable();
            $table->decimal('berat', 8, 2)->nullable();
            $table->string('sku', 50)->nullable()->unique();
            $table->integer('stok')->default(0);
            $table->string('finishing', 100)->nullable();
            $table->decimal('panjang', 8, 2)->nullable();
            $table->decimal('lebar', 8, 2)->nullable();
            $table->decimal('tinggi', 8, 2)->nullable();
            $table->string('koleksi', 100)->nullable();
            $table->enum('visibilitas', ['aktif', 'draft'])->default('draft');
            $table->boolean('is_unggulan')->default(false);
            $table->boolean('terima_kustom')->default(true);
            $table->enum('status', ['tersedia', 'pre_order', 'habis'])->default('tersedia');
            $table->timestamps();
            $table->softDeletes();

            $table->index('kategori_id');
            $table->index('jenis_kayu_id');
            $table->index('status');
            $table->index('visibilitas');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
