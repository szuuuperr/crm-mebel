<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->enum('tipe', ['pesanan', 'pesan', 'review', 'stok', 'pembayaran', 'sistem']);
            $table->string('judul');
            $table->text('pesan')->nullable();
            $table->string('icon', 100)->nullable();
            $table->string('url')->nullable();
            $table->timestamp('dibaca_pada')->nullable();
            $table->timestamps();

            $table->index('user_id');
            $table->index('dibaca_pada');
            $table->index('tipe');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
