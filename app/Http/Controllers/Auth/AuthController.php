<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegistryRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;

/**
 * API для авторизации и аутентификации
 *
 * @group Авторизация
 */
class AuthController extends Controller
{
    /**
     * Запрос на авторизацию по логину и паролю
     *
     * @param LoginRequest $request
     * @return JsonResponse
     * @throws ValidationException
     * @unauthenticated
     */
    public function signIn(LoginRequest $request): JsonResponse
    {
        $this->ensureIsNotRateLimited($request);

        // Авторизуем
        $credentials = $request->only('email', 'password');
        $token = JWTAuth::attempt($credentials);

        // Неверные данные
        if (!$token) {
            $this->incrementLoginAttempts($request);
            throw ValidationException::withMessages([
                'email' => ['Предоставленные учетные данные неверны.'],
            ]);
        }

        $this->clearLoginAttempts($request);

        // Получаем авторизованного пользователя
        $user = Auth::user();

        return response()->json([
            'data' => [
                'accessToken' => $token,
                'type' => 'bearer',
                'user' => $user,
            ]
        ]);
    }

    /**
     * Запрос на регистрацию
     *
     * @param RegistryRequest $request
     * @return UserResource
     * @unauthenticated
     */
     public function signUp(RegistryRequest $request): UserResource
     {
         $data = $request->validated();

         $user = User::query()->create(
             [
                 'first_name' => $data['first_name'],
                 'middle_name' => $data['middle_name'],
                 'email' => $data['email'],
                 'password' => Hash::make($data['password']),
                 'role_id' => $data['role_id'],
             ]
         );

         return new UserResource($user);
     }

    /**
     * Запрос на деаутентификацию
     *
     * @return JsonResponse
     */
    public function signOut(): JsonResponse
    {
        Auth::logout();
        return response()->json([
            'message' => 'Выход произведен успешно',
        ]);
    }

    /**
     * Маршрут получения информации о пользователе
     *
     * Возвращает всю информацию о User для обновления этих данных в хранилище на фронте
     *
     * @return JsonResponse
     */
    public function userInfo(): JsonResponse
    {
        // Получаем авторизованного пользователя
        $user = Auth::user();

        return response()->json([
            'data' => $user
        ]);
    }

    protected function ensureIsNotRateLimited(Request $request)
    {
        if (RateLimiter::tooManyAttempts($this->throttleKey($request), 5)) {
            throw new TooManyRequestsHttpException(60, 'Слишком много запросов на авторизацию. Повторите попытку через 1 минуту.');
        }
    }

    protected function incrementLoginAttempts(Request $request)
    {
        RateLimiter::hit($this->throttleKey($request), 60);
    }

    protected function clearLoginAttempts(Request $request)
    {
        RateLimiter::clear($this->throttleKey($request));
    }

    protected function throttleKey(Request $request)
    {
        return strtolower($request->input('email')) . '|' . $request->ip();
    }
}
