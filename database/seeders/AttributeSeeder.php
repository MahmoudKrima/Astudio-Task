<?php

namespace Database\Seeders;

use App\Models\Attribute;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $department = Attribute::create([
            'name' => 'Department',
            'type' => 'select',
            'options' => json_encode(['IT', 'HR', 'Marketing'])
        ]);

        $startDate = Attribute::create([
            'name' => 'Start Date',
            'type' => 'date',
        ]);

        $endDate = Attribute::create([
            'name' => 'End Date',
            'type' => 'date',
        ]);

        cache()->put('department', $department->id);
        cache()->put('start_date', $startDate->id);
        cache()->put('end_date', $endDate->id);
    }
}
