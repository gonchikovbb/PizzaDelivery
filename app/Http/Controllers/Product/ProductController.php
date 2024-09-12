<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductCreateRequest;
use App\Http\Requests\Product\ProductUpdateRequest;
use App\Http\Resources\Product\ProductResource;
use App\Models\Product\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProductController extends Controller
{
    /**
     * Показать все Продукты
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     * @apiResourceCollection App\Http\Resources\Product\ProductResource
     * @apiResourceModel App\Models\Product\Product
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $models = Product::query()
            ->paginate($request->get('per_page') ?? 25);
        return ProductResource::collection($models);
    }

    /**
     * Создать Продукт
     *
     * @param ProductCreateRequest $request
     * @apiResource App\Http\Resources\Product\ProductResource
     * @apiResourceModel App\Models\Product\Product
     */
    public function store(ProductCreateRequest $request): ProductResource
    {
        return new ProductResource(Product::create($request->validated()));
    }

    /**
     * Показать Продукт
     *
     * @param Product $product
     * @return ProductResource
     * @apiResource App\Http\Resources\Product\ProductResource
     * @apiResourceModel App\Models\Product\Product
     */
    public function show(Product $product): ProductResource
    {
        return new ProductResource($product);
    }

    /**
     * Обновить Продукт
     *
     * @param ProductUpdateRequest $request
     * @param Product $product
     * @return ProductResource
     */
    public function update(ProductUpdateRequest $request, Product $product): ProductResource
    {
        $product->update($request->validated());
        return new ProductResource($product);
    }

    /**
     * Удалить Продукт
     *
     * @param Product $product
     * @return JsonResponse
     */
    public function destroy(Product $product): JsonResponse
    {
        $product->delete();

        return response()->json(['message' => 'Продукт успешно удален.'], 204);
    }

    /**
     * Показать Продукты по категориям
     *
     * @param int $categoryId
     * @param Request $request
     * @return AnonymousResourceCollection
     * @apiResourceCollection App\Http\Resources\Product\ProductResource
     * @apiResourceModel App\Models\Product\Product
     */
    public function getByCategory(int $categoryId, Request $request): AnonymousResourceCollection
    {
        $models = Product::where('category_id', $categoryId)
            ->paginate($request->get('per_page') ?? 25);
        return ProductResource::collection($models);
    }
}
