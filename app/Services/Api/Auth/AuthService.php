<?php

namespace App\Services\Api\Auth;

use App\Http\Resources\Api\User\ShortUserResource;
use App\Models\User;
use App\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class AuthService
{
    public function register($request)
    {
        try {

            DB::beginTransaction();

            $data = $request->validated();

            $user = User::create([
                'first_name' =>  $data['first_name'],
                'last_name' =>  $data['last_name'],
                'email' =>  $data['email'],
                'password' =>  $data['password'],
            ]);

            $token = $user->createToken('Astudio')->accessToken;

            DB::commit();

            return ApiResponseTrait::apiResponse(['user' => new ShortUserResource($user), 'token' => $token], __('User registered successfully'));
        } catch (\Exception $e) {

            DB::rollBack();

            return ApiResponseTrait::apiResponse(
                [],
                __('Registration failed'),
                [],
                500
            );
        }
    }


    public function login($request)
    {
        $data = $request->validated();

        if (!Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            return ApiResponseTrait::apiResponse(
                [],
                __('Wrong Credentials'),
                [],
                422
            );
        }

        $user = Auth::user();

        $token = $user->createToken('Astudio')->accessToken;

        return  ApiResponseTrait::apiResponse(['user' => new ShortUserResource($user), 'token' => $token], __('User Login successfully'));
    }

    public function logout($request)
    {
        $request->user()->token()->revoke();
    }
}
