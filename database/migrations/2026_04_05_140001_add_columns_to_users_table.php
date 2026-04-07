<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'pengrajin', 'manajer'])->default('pengrajin')->after('password');
            $table->string('jabatan')->nullable()->after('role');
            $table->string('telepon', 20)->nullable()->after('jabatan');
            $table->string('avatar')->nullable()->after('telepon');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'jabatan', 'telepon', 'avatar']);
        });
    }
};
