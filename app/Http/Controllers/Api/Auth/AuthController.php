<?php


namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Services\Api\Auth\AuthService;
use App\Http\Requests\Api\Auth\RegisterRequest;

class AuthController extends Controller
{
    public function __construct(private AuthService $authService) {}

    public function register(RegisterRequest $request)
    {
        return $this->authService->register($request);
    }

    public function login(LoginRequest $request)
    {
        return $this->authService->login($request);
    }

    public function logout(Request $request)
    {
        $this->authService->logout($request);
        return ApiResponseTrait::apiResponse(message: __('Successfully logged out'));
    }
}
