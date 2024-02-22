<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $initJobsData =[
            [
                'name' => 'Frontend Web Programmer',
                'created_by' =>1,
                'updated_by' =>1,
            ],
            [
                'name' => 'Fullstack Web Programmer',
                'created_by' =>1,
                'updated_by' =>1,
            ],
            [
                'name' => 'Quality Control',
                'created_by' =>1,
                'updated_by' =>1,
            ],
        ];
        // insert data to database
        foreach ($initJobsData as $job) {
            \App\Models\jobs::create($job);
        }
    }
}
