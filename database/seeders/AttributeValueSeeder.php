<?php

namespace Database\Seeders;

use App\Models\AttributeValue;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AttributeValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $project1 = cache()->get('project1');
        $project2 = cache()->get('project2');
        $department = cache()->get('department');
        $startDate = cache()->get('start_date');
        $endDate = cache()->get('end_date');

        AttributeValue::create([
            'attribute_id' => $department,
            'entity_id' => $project1,
            'value' => 'IT',
        ]);

        AttributeValue::create([
            'attribute_id' => $department,
            'entity_id' => $project2,
            'value' => 'Marketing',
        ]);

        AttributeValue::create([
            'attribute_id' => $startDate,
            'entity_id' => $project1,
            'value' => '2025-03-03',
        ]);

        AttributeValue::create([
            'attribute_id' => $endDate,
            'entity_id' => $project1,
            'value' => '2025-03-15',
        ]);
    }
}
