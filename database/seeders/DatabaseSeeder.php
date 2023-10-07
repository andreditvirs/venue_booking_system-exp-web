<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\VenueSeeder;
use Database\Seeders\JadwalBookingSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(VenueSeeder::class);
        $this->call(JadwalBookingSeeder::class);
    }
}
