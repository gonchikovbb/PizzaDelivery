<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserCreateRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController extends Controller
{
    /**
     * Показать всех Пользователей
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     * @apiResourceCollection App\Http\Resources\User\UserResource
     * @apiResourceModel App\Models\User\User
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        auth()->user()->isAdmin();
        $models = User::query()
            ->paginate($request->get('per_page') ?? 25);
        return UserResource::collection($models);
    }

    /**
     * Создать Пользователя
     *
     * @param UserCreateRequest $request
     * @return UserResource
     * @apiResource App\Http\Resources\User\UserResource
     * @apiResourceModel App\Models\User\User
     */
    public function store(UserCreateRequest $request): UserResource
    {
        return new UserResource(User::create($request->validated()));
    }

    /**
     * Показать Пользователя
     *
     * @param User $user
     * @return UserResource
     * @apiResource App\Http\Resources\User\UserResource
     * @apiResourceModel App\Models\User\User
     */
    public function show(User $user): UserResource
    {
        return new UserResource($user);
    }

    /**
     * Обновить Пользователя
     *
     * @param UserUpdateRequest $request
     * @param User $user
     * @return UserResource
     */
    public function update(UserUpdateRequest $request, User $user): UserResource
    {
        $user->update($request->validated());
        return new UserResource($user);
    }

    /**
     * Удалить Пользователя
     *
     * @param User $user
     * @return JsonResponse
     */
    public function destroy(User $user): JsonResponse
    {
        $user->delete();

        return response()->json(['message' => 'Пользователь успешно удален.'], 204);
    }
}
