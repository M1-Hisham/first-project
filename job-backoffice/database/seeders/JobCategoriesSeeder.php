<?php

namespace Database\Seeders;

use App\Models\JobCategories;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // seed data to test with
        $jobData = json_decode(file_get_contents(database_path('data/job_data.json')), true);

        // create job categories
        foreach($jobData['jobCategories'] as $category){
            JobCategories::firstOrCreate([
                'name' => $category,
            ]);
        }
    }
}
