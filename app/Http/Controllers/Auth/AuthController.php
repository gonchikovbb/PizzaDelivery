<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\API\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\User\UserController;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegistryRequest;
use App\Http\Requests\User\UserCreateRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthController extends BaseController
{
    /**
     * Регистрация нового пользователя.
     */
    public function register(UserCreateRequest $request): JsonResponse
    {
        // Используем метод store из UserController для создания пользователя
        $userController = new UserController();
        $userResource = $userController->store($request);

        $success['token'] =  $userResource->createToken('MyApp')->plainTextToken;
        $success['name'] =  $userResource->name;

        return $this->sendResponse($success, 'User register successfully.');
    }

    /**
     * Вход пользователя в систему.
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = $request->only('email', 'password');

        if (!$token = Auth::attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json(compact('token'));
    }

    /**
     * Get the authenticated User.
     *
     * @return Response
     */
    public function profile(): Response
    {
        $success = auth()->user();

        return $this->sendResponse($success, 'Refresh token return successfully.');
    }

    /**
     * Выход пользователя из системы.
     */
    public function logout(): JsonResponse
    {
        Auth::logout();
        return response()->json(['message' => 'Вы успешно вышли из системы'], 200);
    }

    /**
     * Refresh a token.
     *
     * @return Response
     */
    public function refresh(): Response
    {
        $success = $this->respondWithToken(auth()->refresh());

        return $this->sendResponse($success, 'Refresh token return successfully.');
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return array
     */
    protected function respondWithToken($token): array
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ];
    }
}
