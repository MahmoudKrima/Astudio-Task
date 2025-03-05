<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user1 = cache()->get('user1');
        $user2 = cache()->get('user2');

        $project1 = Project::create([
            'name' => 'Project One',
            'status' => 'active',
            'creator_id' => $user1,
        ]);

        $project2 = Project::create([
            'name' => 'Project Two',
            'status' => 'pending',
            'creator_id' => $user2,
        ]);

        cache()->put('project1', $project1->id);
        cache()->put('project2', $project2->id);
    }
}
