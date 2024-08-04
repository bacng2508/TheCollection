<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UpdateUserProfileRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function show(User $user) {
        return new UserResource($user);
    }

    public function update(UpdateUserProfileRequest $request, User $user) {
        $validated = $request->validated();

        $user->update($validated);

        return new UserResource($user);
    }
}
