<?php

namespace Database\Seeders;

use App\Models\Companies;
use App\Models\JobCategories;
use App\Models\JobVacancy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobVacancySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jobVacancies = json_decode(file_get_contents(database_path('data/job_data.json')), true);
        foreach ($jobVacancies['jobVacancies'] as $jobVacancy) {

            $category = JobCategories::where('name', $jobVacancy['category'])->firstOrFail();

            $company = Companies::where('name', $jobVacancy['company'])->firstOrFail();

            JobVacancy::firstOrCreate(
                [
                    'title' => $jobVacancy['title'],
                    'companyId' => $company->id,
                ],
                [
                    'description' => $jobVacancy['description'],
                    'location' => $jobVacancy['location'],
                    'type' => $jobVacancy['type'],
                    'salary' => $jobVacancy['salary'],
                    'categoryId' => $category->id,
                ]
            );
        }
    }
}
