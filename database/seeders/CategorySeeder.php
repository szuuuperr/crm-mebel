<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['nama' => 'Dipan', 'icon' => 'bed'],
            ['nama' => 'Backdrop', 'icon' => 'wallpaper'],
            ['nama' => 'Lemari', 'icon' => 'dresser'],
            ['nama' => 'Meja', 'icon' => 'desk'],
            ['nama' => 'Rak', 'icon' => 'shelves'],
            ['nama' => 'Meja Kursi', 'icon' => 'table_restaurant'],
            ['nama' => 'Nakas', 'icon' => 'nightlight'],
            ['nama' => 'Ayunan', 'icon' => 'swing'],
            ['nama' => 'Gazebo', 'icon' => 'cottage'],
            ['nama' => 'Bangku', 'icon' => 'event_seat'],
            ['nama' => 'Meja Makan', 'icon' => 'dining'],
            ['nama' => 'Kursi', 'icon' => 'chair'],
        ];

        foreach ($categories as $category) {
            DB::table('categories')->insert([
                'nama' => $category['nama'],
                'slug' => Str::slug($category['nama']),
                'deskripsi' => null,
                'icon' => $category['icon'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
