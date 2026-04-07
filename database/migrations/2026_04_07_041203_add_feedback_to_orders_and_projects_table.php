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
        Schema::table('orders', function (Blueprint $table) {
            $table->tinyInteger('rating')->nullable();
            $table->text('keluhan_masukan')->nullable();
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->tinyInteger('rating')->nullable();
            $table->text('keluhan_masukan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['rating', 'keluhan_masukan']);
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn(['rating', 'keluhan_masukan']);
        });
    }
};
