<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SkillsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $initSkillsData =[
            [
                'name' => 'PHP',
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'name' => 'PostgreSQL',
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'name' => 'API (JSON, REST)',
                'created_by' => 1,
                'updated_by' => 1,
            ],
        ];
        // insert data to database
        foreach ($initSkillsData as $skill) {
            \App\Models\skills::create($skill);
        }
    }
}
