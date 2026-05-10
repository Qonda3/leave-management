<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * 
     * Run the core seeders required to populate
     * leave types and initial user account.
     */
    public function run(): void
    {
        $this->call([
            LeaveTypeSeeder::class,
            UserSeeder::class,
        ]);
    }
}
