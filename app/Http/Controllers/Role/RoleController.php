<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use App\Http\Requests\Role\RoleRequest;
use App\Http\Resources\Role\RoleResource;
use App\Models\Role\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class RoleController extends Controller
{
    /**
     * Показать все Роли
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     * @apiResourceCollection App\Http\Resources\Role\RoleResource
     * @apiResourceModel App\Models\Role\Role
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $models = Role::query()
            ->paginate($request->get('per_page') ?? 25);
        return RoleResource::collection($models);
    }

    /**
     * Создать Роль
     *
     * @param RoleRequest $request
     * @return RoleResource
     * @apiResource App\Http\Resources\Role\RoleResource
     * @apiResourceModel App\Models\Role\Role
     */
    public function store(RoleRequest $request): RoleResource
    {
        return new RoleResource(Role::create($request->validated()));
    }

    /**
     * Показать Роль
     *
     * @param Role $role
     * @return RoleResource
     * @apiResource App\Http\Resources\Role\RoleResource
     * @apiResourceModel App\Models\Role\Role
     */
    public function show(Role $role): RoleResource
    {
        return new RoleResource($role);
    }

    /**
     * Обновить Роль
     *
     * @param RoleRequest $request
     * @param Role $role
     * @return RoleResource
     */
    public function update(RoleRequest $request, Role $role): RoleResource
    {
        $role->update($request->validated());
        return new RoleResource($role);
    }

    /**
     * Удалить Роль
     *
     * @param Role $role
     * @return JsonResponse
     */
    public function destroy(Role $role): JsonResponse
    {
        $role->delete();

        return response()->json(['message' => 'Роль успешно удалена.'], 204);
    }
}
