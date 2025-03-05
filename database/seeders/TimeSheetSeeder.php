<?php

namespace Database\Seeders;

use App\Models\Timesheet;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TimeSheetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user1 = cache()->get('user1');
        $user2 = cache()->get('user2');
        $project1 = cache()->get('project1');
        $project2 = cache()->get('project2');

        Timesheet::create([
            'task_name' => 'UI',
            'date' => now(),
            'hours' => 5,
            'user_id' => $user1,
            'project_id' => $project1,
        ]);

        Timesheet::create([
            'task_name' => 'Backend',
            'date' => now(),
            'hours' => 7,
            'user_id' => $user2,
            'project_id' => $project1,
        ]);

        Timesheet::create([
            'task_name' => 'Frontend',
            'date' => now(),
            'hours' => 4,
            'user_id' => $user1,
            'project_id' => $project2,
        ]);
    }
}
