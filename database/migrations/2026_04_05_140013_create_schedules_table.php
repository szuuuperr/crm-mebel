<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('customer_id')->nullable()->constrained('customers')->onDelete('set null');
            $table->foreignId('project_id')->nullable()->constrained('projects')->onDelete('set null');
            $table->enum('tipe', ['deadline', 'pengiriman', 'pertemuan', 'pengambilan', 'proposal', 'perawatan', 'lainnya']);
            $table->dateTime('tanggal_mulai');
            $table->dateTime('tanggal_selesai')->nullable();
            $table->string('warna', 50)->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();

            $table->index('tanggal_mulai');
            $table->index('tipe');
            $table->index('user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
