<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->foreignId('jenis_kayu_id')->nullable()->constrained('wood_types')->onDelete('set null');
            $table->string('finishing')->nullable();
            $table->float('panjang')->nullable();
            $table->float('lebar')->nullable();
            $table->float('tinggi')->nullable();
            $table->float('berat')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropForeign(['jenis_kayu_id']);
            $table->dropColumn(['jenis_kayu_id', 'finishing', 'panjang', 'lebar', 'tinggi', 'berat']);
        });
    }
};
