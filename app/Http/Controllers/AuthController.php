<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AuthResource;
use App\Models\Usuario;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        if (!Auth::attempt($request->only('email', 'password')) && !$request->only('username', 'password')) {
            return response()->json([
                'message' => 'Invalid login details'
            ], 401);
        }
        $user = Usuario::where('email', $request['email'])->orWhere('username', $request['username'])->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type'   => 'Bearer',
        ]);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function me(Request $request)
    {
        return new AuthResource($request->user());
    }
}