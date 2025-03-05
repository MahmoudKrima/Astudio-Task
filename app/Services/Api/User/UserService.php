<?php

namespace App\Services\Api\User;

use App\Models\User;

class UserService
{
    public function index()
    {
        return User::with('projects.attributes.attribute', 'projects.users')
            ->paginate();
    }

    public function show($user)
    {
        return User::with('projects.attributes.attribute', 'projects.users')
            ->findOrFail($user->id);
    }

    public function store($request)
    {
        $data = $request->validated();
        return User::create($data);
    }

    public function update($request, $user)
    {
        $data = $request->validated();
        $user = User::findOrFail($user->id);
        if (!isset($data['password'])) {
            unset($data['password']);
        }
        $user->update($data);
        return $user;
    }

    public function delete($user)
    {
        $user->delete();
    }
}
