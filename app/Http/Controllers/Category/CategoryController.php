<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryRequest;
use App\Http\Resources\Category\CategoryResource;
use App\Models\Category\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CategoryController extends Controller
{
    /**
     * Показать все Категории
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     * @apiResourceCollection App\Http\Resources\Category\CategoryResource
     * @apiResourceModel App\Models\Category\Category
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $models = Category::query()
            ->paginate($request->get('per_page') ?? 25);
        return CategoryResource::collection($models);
    }

    /**
     * Создать Категорию
     *
     * @param CategoryRequest $request
     * @return CategoryResource
     * @apiResource App\Http\Resources\Category\CategoryResource
     * @apiResourceModel App\Models\Category\Category
     */
    public function store(CategoryRequest $request): CategoryResource
    {
        return new CategoryResource(Category::create($request->validated()));
    }

    /**
     * Показать Категорию
     *
     * @param Category $category
     * @return CategoryResource
     * @apiResource App\Http\Resources\Category\CategoryResource
     * @apiResourceModel App\Models\Category\Category
     */
    public function show(Category $category): CategoryResource
    {
        return new CategoryResource($category);
    }

    /**
     * Обновить Категорию
     *
     * @param CategoryRequest $request
     * @param Category $category
     * @return CategoryResource
     */
    public function update(CategoryRequest $request, Category $category): CategoryResource
    {
        $category->update($request->validated());
        return new CategoryResource($category);
    }

    /**
     * Удалить Категорию
     *
     * @param Category $category
     * @return JsonResponse
     */
    public function destroy(Category $category): JsonResponse
    {
        $category->delete();

        return response()->json(['message' => 'Категория успешно удалена.'], 204);
    }
}
