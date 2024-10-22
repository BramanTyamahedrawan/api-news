<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Models\User;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;


class UserController extends Controller
{

    public function login(LoginRequest $request): JsonResponse
    {
        $data = $request->validated();

        $user = User::where('username', $data['username'])->first();

        if (!$user) {
            throw new HttpResponseException(response()->json([
                'errors' => [
                    'message' => 'Unauthorized',
                ],
            ], 401));
        }

        if (!Hash::check($data['password'], $user->password)) {
            throw new HttpResponseException(response()->json([
                'errors' => [
                    'message' => 'Unauthorized',
                ],
            ], 401));
        }

        try {
            $token = JWTAuth::fromUser($user);
        } catch (\Exception $e) {
            throw new HttpResponseException(response()->json([
                'errors' => [
                    'message' => 'Internal server error',
                ],
            ], 500));
        }

        return response()->json([
            'data' => [
                'username' => $user->username,
                'name' => $user->name,
                'token' => $token,
            ]
        ], Response::HTTP_OK);
    }
}
