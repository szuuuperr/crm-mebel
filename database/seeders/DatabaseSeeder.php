<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            WoodTypeSeeder::class,
            ProductSeeder::class,
            CustomerSeeder::class,
            OrderSeeder::class,
            PaymentSeeder::class,
            ProjectSeeder::class,
            ScheduleSeeder::class,
            NotificationSeeder::class,
        ]);
    }
}
