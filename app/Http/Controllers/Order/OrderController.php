<?php

namespace App\Http\Controllers\Order;

use App\Exceptions\OrderException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\OrderCreateRequest;
use App\Http\Requests\Order\OrderUpdateRequest;
use App\Http\Resources\Order\OrderResource;
use App\Models\Cart\Cart;
use App\Models\Cart\CartItem;
use App\Models\Order\Order;
use App\Models\Order\OrderItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class OrderController extends Controller
{
    /**
     * Показать все Заказы
     *
     * @param Request $request
     * @return
     * @apiResourceCollection App\Http\Resources\Order\OrderResource
     * @apiResourceModel App\Models\Order\Order
     */
    public function index(Request $request)
    {
        return Order::where('user_id', auth()->id())->with('orderItems.product')->get();
    }

    /**
     * Создать Заказ
     *
     * @param OrderCreateRequest $request
     * @apiResource App\Http\Resources\Order\OrderResource
     * @apiResourceModel App\Models\Order\Order
     */
    public function store(OrderCreateRequest $request): OrderResource|JsonResponse
    {
        DB::beginTransaction(); // Начинаем транзакцию

        try {
            $order = Order::query()->create([
                'user_id' => Auth::user()->id,
                'phone_number' => $request->get('phone_number'),
                'email' => $request->get('email'),
                'address_id' => $request->get('address_id'),
                'delivery_time' => $request->get('delivery_time'),
                'status' => 0,
            ]);

            $cart = Cart::query()->where('user_id', auth()->id())->first();

            // Проверяем, существует ли корзина
            if (!$cart) {
                throw new OrderException('Корзина не найдена.');
            }

            $cartItems = CartItem::query()->where('cart_id', $cart->id)->get();

            // Проверяем, существуют ли товары в корзине
            if ($cartItems->isEmpty()) { // Изменено условие на isEmpty()
                throw new OrderException('Корзина пуста.');
            }

            foreach ($cartItems as $cartItem) {
                OrderItem::query()->create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'quantity' => $cartItem->quantity,
                ]);
            }

            // Очищаем корзину после создания заказа (опционально)
            $cartItems->each->delete();

            DB::commit(); // Подтверждаем транзакцию

        } catch (OrderException $e) { //
            DB::rollBack(); // Откатываем транзакцию в случае ошибки
            // Обработка исключений, например, логирование ошибки
            \Log::error('Ошибка при создании заказа: ' . $e->getMessage());
            return response()->json(['error' => 'Не удалось создать заказ.'], 500);
        }

        return new OrderResource($order);
    }

    /**
     * Показать Заказ
     *
     * @param Order $order
     * @return \Illuminate\Database\Eloquent\Collection
     * @apiResource App\Http\Resources\Order\OrderResource
     * @apiResourceModel App\Models\Order\Order
     */
    public function show(Order $order)
    {
        return $order->orderItems()->with('product')->get();
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

        return response()->json(['message' => 'Заказ успешно удален.'], 204);
    }
}
