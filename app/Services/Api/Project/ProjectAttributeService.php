<?php

namespace App\Services\Api\Project;

use App\Models\Attribute;

class ProjectAttributeService
{

    public function index()
    {
        return Attribute::with('values')
            ->paginate();
    }

    public function show($attribute)
    {
        return Attribute::with('values')
            ->findOrFail($attribute->id);
    }

    public function store($request)
    {
        $data = $request->validated();

        if ($data['type'] === 'select' && isset($data['options'])) {
            $data['options'] = json_encode(array_unique($data['options']));
        } else {
            $data['options'] = null;
        }

        return Attribute::create($data);
    }

    public function update($request, $attribute)
    {
        $data = $request->validated();
        $attribute = Attribute::findOrFail($attribute->id);
        if ($data['type'] === 'select' && isset($data['options'])) {
            $data['options'] = json_encode(array_unique($data['options']));
        } else {
            $data['options'] = null;
        }

        $attribute->update($data);

        return $attribute;
    }

    public function delete($attribute)
    {
        $attribute->delete();
    }
}
