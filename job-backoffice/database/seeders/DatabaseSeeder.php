<?php

namespace Database\Seeders;

use App\Models\User;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::firstOrCreate(
            [
                'email' => 'admin@admin.com',
            ],
            [
                'name' => 'Admin User',
                'password' => Hash::make('12345678'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );
        $this->call([
            JobCategoriesSeeder::class,
            CompaniesSeeder::class,
            JobVacancySeeder::class,
        ]);
    }
}
