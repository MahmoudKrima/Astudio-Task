<?php

namespace App\Http\Controllers\Api\Project;

use App\Models\Project;
use App\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\Api\Project\ProjectService;
use App\Http\Resources\Api\Project\ProjectResoruce;
use App\Http\Resources\Api\Project\ProjectCollection;
use App\Http\Requests\Api\Project\StoreProjectRequest;
use App\Http\Requests\Api\Project\FilterProjectRequest;
use App\Http\Requests\Api\Project\UpdateProjectRequest;

class ProjectController extends Controller
{
    public function __construct(private ProjectService $projectService) {}

    public function index(FilterProjectRequest $request)
    {
        $projects = $this->projectService->index($request);
        return ApiResponseTrait::apiResponse(new ProjectCollection($projects));
    }

    public function show(Project $project)
    {
        $project = $this->projectService->show($project);
        return ApiResponseTrait::apiResponse(['project' => new ProjectResoruce($project)]);
    }

    public function store(StoreProjectRequest $request)
    {
        $project = $this->projectService->store($request);
        return ApiResponseTrait::apiResponse(['project' => new ProjectResoruce($project)], "Project Created Successfully", status: 201);
    }

    public function update(UpdateProjectRequest $request, Project $project)
    {
        if ($project->creator_id == Auth::guard('api')->id()) {
            $project = $this->projectService->update($request, $project);
            return ApiResponseTrait::apiResponse(['project' => new ProjectResoruce($project)], "Project Updated Successfully");
        } else {
            return ApiResponseTrait::apiResponse([], "Unauthorized To Update Project", [], 401);
        }
    }

    public function delete(Project $project)
    {
        if ($project->creator_id == Auth::guard('api')->id()) {
            $this->projectService->delete($project);
            return ApiResponseTrait::apiResponse(message: "Project Deleted Successfully", status: 200);
        } else {
            return ApiResponseTrait::apiResponse([], "Unauthorized To Delete Project", [], 401);
        }
    }
}
