<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\ErrorResource;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\TokenResource;
use App\Http\Resources\UserResource;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(LoginRequest $request)
    {
        $token = auth()->attempt($request->validated()) ;

        if (!$token) {
            return ErrorResource::make(['message' => 'safddsafsd']);
        }

        return SuccessResource::make([
            'user' => UserResource::make(auth()->user()),
            'token' => TokenResource::make([
                'token' => $token,
                'expires_at' => auth()->factory()->getTTL() * 60
            ])
        ]);
    }
}
