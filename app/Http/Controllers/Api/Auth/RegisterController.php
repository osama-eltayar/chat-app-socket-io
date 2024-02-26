<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\TokenResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(RegisterRequest $request)
    {
        $user = User::create($request->validated());

        $token = auth()->login($user);

        return SuccessResource::make([
            'user' => UserResource::make($user),
            'token' => TokenResource::make([
                'token' => $token,
                'expires_at' => auth()->factory()->getTTL() * 60
            ])
        ]);
    }
}
