<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\OrderCreateRequest;
use App\Http\Requests\Order\OrderUpdateRequest;
use App\Http\Resources\Order\OrderResource;
use App\Models\Order\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class OrderController extends Controller
{
    /**
     * Показать все Заказы
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     * @apiResourceCollection App\Http\Resources\Order\OrderResource
     * @apiResourceModel App\Models\Order\Order
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $models = Order::query()
            ->paginate($request->get('per_page') ?? 25);
        return OrderResource::collection($models);
    }

    /**
     * Создать Заказ
     *
     * @param OrderCreateRequest $request
     * @apiResource App\Http\Resources\Order\OrderResource
     * @apiResourceModel App\Models\Order\Order
     */
    public function store(OrderCreateRequest $request): OrderResource
    {
        return new OrderResource(Order::create($request->validated()));
    }

    /**
     * Показать Заказ
     *
     * @param Order $order
     * @return OrderResource
     * @apiResource App\Http\Resources\Order\OrderResource
     * @apiResourceModel App\Models\Order\Order
     */
    public function show(Order $order): OrderResource
    {
        return new OrderResource($order);
    }

    /**
     * Обновить Заказ
     *
     * @param OrderUpdateRequest $request
     * @param Order $order
     * @return OrderResource
     */
    public function update(OrderUpdateRequest $request, Order $order): OrderResource
    {
        $order->update($request->validated());
        return new OrderResource($order);
    }

    /**
     * Удалить Заказ
     *
     * @param Order $order
     * @return JsonResponse
     */
    public function destroy(Order $order): JsonResponse
    {
        $order->delete();

        return response()->json(['message' => 'Заказ успешно удален.'], 200);
    }
}
