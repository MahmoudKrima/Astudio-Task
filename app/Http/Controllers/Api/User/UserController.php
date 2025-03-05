<?php

namespace App\Http\Controllers\Api\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Services\Api\User\UserService;
use App\Http\Resources\Api\User\UserResource;
use App\Http\Resources\Api\User\UserCollection;
use App\Http\Requests\Api\User\StoreUserRequest;
use App\Http\Requests\Api\User\UpdateUserRequest;

class UserController extends Controller
{
    use ApiResponseTrait;

    public function __construct(private UserService $userService)
    {
    }

    public function index()
    {
        $users = $this->userService->index();
        return ApiResponseTrait::apiResponse(new UserCollection($users));
    }

    public function show(User $user)
    {
        $user = $this->userService->show($user);
        return ApiResponseTrait::apiResponse(['user' => new UserResource($user)]);
    }

    public function store(StoreUserRequest $request)
    {
        $user = $this->userService->store($request);
        return ApiResponseTrait::apiResponse(['user' => new UserResource($user)], "User Created Successfully", status: 201);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user = $this->userService->update($request, $user);
        return ApiResponseTrait::apiResponse(['user' => new UserResource($user)], "User Updated Successfully");
    }

    public function delete(User $user)
    {
        $this->userService->delete($user);
        return ApiResponseTrait::apiResponse(message: "User Deleted Successfully", status: 200);
    }
}
