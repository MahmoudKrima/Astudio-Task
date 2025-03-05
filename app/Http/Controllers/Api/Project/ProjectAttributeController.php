<?php

namespace App\Http\Controllers\Api\Project;

use App\Models\Attribute;
use App\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Services\Api\Project\ProjectAttributeService;
use App\Http\Resources\Api\ProjectAttribute\ProjectAttributeResoruce;
use App\Http\Resources\Api\ProjectAttribute\ProjectAttributeCollection;
use App\Http\Requests\Api\ProjectAttribute\StoreProjectAttributeRequest;
use App\Http\Requests\Api\ProjectAttribute\UpdateProjectAttributeRequest;

class ProjectAttributeController extends Controller
{
    public function __construct(private ProjectAttributeService $projectAttributeService) {}


    public function index()
    {
        $attributes = $this->projectAttributeService->index();
        return ApiResponseTrait::apiResponse(new ProjectAttributeCollection($attributes));
    }

    public function show(Attribute $attribute)
    {
        $attributes = $this->projectAttributeService->show($attribute);
        return ApiResponseTrait::apiResponse(['projectAttribute' => new ProjectAttributeResoruce($attributes)]);
    }

    public function store(StoreProjectAttributeRequest $request)
    {
        $attribute = $this->projectAttributeService->store($request);
        return ApiResponseTrait::apiResponse(['projectAttribute' => new ProjectAttributeResoruce($attribute)], "Attribute Created Successfully", status: 201);
    }

    public function update(UpdateProjectAttributeRequest $request, Attribute $attribute)
    {
        $attribute = $this->projectAttributeService->update($request, $attribute);
        return ApiResponseTrait::apiResponse(['projectAttribute' => new ProjectAttributeResoruce($attribute)], "Attribute Updated Successfully");
    }
    public function delete(Attribute $attribute)
    {
        $this->projectAttributeService->delete($attribute);
        return ApiResponseTrait::apiResponse(message: "Attribute Deleted Successfully", status: 200);
    }
}
