<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Ubah enum role di users: tambah 'pelanggan'
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'pengrajin', 'manajer', 'pelanggan') DEFAULT 'pengrajin'");

        // Tambah kolom user_id di customers untuk link ke akun user
        Schema::table('customers', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->after('id')->constrained('users')->onDelete('set null');
            $table->index('user_id');
        });
    }

    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropIndex(['user_id']);
            $table->dropColumn('user_id');
        });

        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'pengrajin', 'manajer') DEFAULT 'pengrajin'");
    }
};
