<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Seed core tables
        $this->call([
            NotificationSeeder::class,
            UsersTableSeeder::class,
            AiTemplateSeeder::class,
        ]);

        // Run module migrations and seeds (if applicable)
        Artisan::call('module:migrate LandingPage');
        Artisan::call('module:seed LandingPage');

        // Optional: Add log or confirmation
        $this->command->info('All seeders have run successfully.');
    }
}
