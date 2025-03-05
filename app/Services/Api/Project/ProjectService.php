<?php

namespace App\Services\Api\Project;

use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class ProjectService
{
    public function index($request)
    {
        $data = $request->validated();
        $query = Project::with('attributes.attribute', 'users');

        if (!empty($data['filters']) && is_array($data['filters'])) {
            foreach ($data['filters'] as $key => $value) {
                if (!empty($value)) {
                    preg_match('/(.+?)([><=!]+)?$/', $key, $matches);
                    $column = $matches[1] ?? $key;
                    $operator = $matches[2] ?? null;

                    if (!$operator) {
                        $operator = $this->isStringValue($value) ? 'LIKE' : '=';
                    }

                    $operator = $this->resolveOperator($operator);

                    if ($this->isProjectColumn($column)) {
                        $query->where($column, $operator, $operator === 'LIKE' ? "%$value%" : $value);
                    } else {
                        $query->whereHas('attributes', function ($q) use ($column, $operator, $value) {
                            $q->whereHas('attribute', function ($attrQuery) use ($column) {
                                $attrQuery->where('name', $column);
                            })->where('value', $operator, $operator === 'LIKE' ? "%$value%" : $value);
                        });
                    }
                }
            }
        }

        return $query->paginate();
    }


    private function isStringValue($value)
    {
        return !is_numeric($value) && strtotime($value) === false;
    }

    private function resolveOperator($operator)
    {
        $allowedOperators = ['=', '>', '<',  'LIKE'];

        return in_array($operator, $allowedOperators) ? $operator : '=';
    }

    private function isProjectColumn($column)
    {
        $tableColumns = Schema::getColumnListing('projects');
        return in_array($column, $tableColumns);
    }


    public function show($project)
    {
        return Project::with('attributes.attribute', 'users')
            ->findOrFail($project->id);
    }

    public function store($request)
    {
        $data = $request->validated();

        $data['creator_id'] = Auth::guard('api')->id();

        $data['status'] = 'pending';

        $project = Project::create($data);

        foreach ($data['attributes'] as $key => $attribute) {
            $project->attributes()
                ->create([
                    'attribute_id' => $attribute,
                    'value' => $data['values'][$key],
                ]);
        }

        if (isset($data['users'])) {
            $project->users()
                ->sync($data['users']);
        }

        return $project;
    }

    public function update($request, $project)
    {
        $data = $request->validated();

        $project->update($data);

        if (isset($data['attributes'])) {
            $project->attributes()
                ->delete();
            foreach ($data['attributes'] as $key => $attribute) {
                $project->attributes()
                    ->create([
                        'attribute_id' => $attribute,
                        'value' => $data['values'][$key],
                    ]);
            }
        }

        if (isset($data['users'])) {
            $project->users()
                ->sync($data['users']);
        }

        return $project;
    }

    public function delete($project)
    {
        $project->delete();
    }
}
