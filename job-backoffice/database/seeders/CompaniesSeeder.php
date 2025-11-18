<?php

namespace Database\Seeders;

use App\Models\Companies;
use App\Models\User;
use Illuminate\Database\Seeder;
use Hash;
use Str;

class CompaniesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $copanies = json_decode(file_get_contents(database_path('data/job_data.json')), true);

        foreach ($copanies['companies'] as $company) {
            // Create user company fake data
            $companyOwner = User::firstOrCreate(
                [
                    // Create user company owner with deterministic email
                    'email' => Str::slug($company['name']) . '@company.com',
                ],
                [
                    'name' => fake()->name(),
                    'password' => Hash::make('123445678'),
                    'role' => 'company_owner',
                    'email_verified_at' => now(),
                ]
            );

            Companies::firstOrCreate(
                [
                    'name' => $company['name'],
                ],
                [
                    'address' => $company['address'],
                    'industry' => $company['industry'],
                    'website' => $company['website'],
                    'owenerId' => $companyOwner->id,
                ]
            );
        }
    }
}
