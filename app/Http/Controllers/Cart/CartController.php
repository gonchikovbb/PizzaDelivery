<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cart\CartItemRequest;
use App\Http\Requests\Cart\CartRequest;
use App\Http\Resources\Cart\CartResource;
use App\Models\Cart\Cart;
use App\Models\Cart\CartItem;
use App\Models\Product\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CartController extends Controller
{
    // Maximum limits for products
    const MAX_PIZZAS = 10;
    const MAX_DRINKS = 20;

    /**
     * Показать все Корзины
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     * @apiResourceCollection App\Http\Resources\Cart\CartResource
     * @apiResourceModel App\Models\Cart\Cart
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $models = Cart::query()
            ->paginate($request->get('per_page') ?? 25);
        return CartResource::collection($models);
    }

    /**
     * Создать Корзину
     *
     * @param CartRequest $request
     * @return CartResource
     * @apiResource App\Http\Resources\Cart\CartResource
     * @apiResourceModel App\Models\Cart\Cart
     */
    public function store(CartRequest $request): CartResource
    {
        return new CartResource(Cart::create($request->validated()));
    }

    /**
     * Показать Корзину
     *
     * @param Cart $cart
     * @return CartResource
     * @apiResource App\Http\Resources\Cart\CartResource
     * @apiResourceModel App\Models\Cart\Cart
     */
    public function show(Cart $cart): CartResource
    {
        return new CartResource($cart);
    }

    /**
     * Обновить Корзину
     *
     * @param CartRequest $request
     * @param Cart $cart
     * @return CartResource
     */
    public function update(CartRequest $request, Cart $cart): CartResource
    {
        $cart->update($request->validated());
        return new CartResource($cart);
    }

    /**
     * Удалить Корзину
     *
     * @param Cart $cart
     * @return JsonResponse
     */
    public function destroy(Cart $cart): JsonResponse
    {
        $cart->delete();

        return response()->json(['message' => 'Корзина успешно удалена.'], 200);
    }



    /**
     * Получить текущие товары в корзине
     *
     * @param Cart $cart
     * @return AnonymousResourceCollection
     */
    public function getCurrentItems(Cart $cart)
    {
        return $cart->cartItems()->with('product')->get();
    }

    /**
     * Добавить продукт в корзину
     *
     * @param CartItemRequest $request
     * @param Cart $cart

     */
    public function addItem(CartItemRequest $request, Cart $cart)
    {
        if (!$cart) {
            return response()->json(['message' => 'Корзина не найдена.'], 404);
        }

        // Получаем текущие товары в корзине
        $currentItems = $this->getCurrentItems($cart);
        $currentPizzas = $currentItems->where('product.category_id', 1)->sum('quantity');
        $currentDrinks = $currentItems->where('product.category_id', 2)->sum('quantity');

        // Проверяем, не превышает ли добавление лимиты
        $newQuantity = $request->quantity;

        $product = Product::find($request->product_id);

        if ($product->category_id === 1) {
            if ($currentPizzas + $newQuantity > self::MAX_PIZZAS) {
                return response()->json(['message' => 'Превышен лимит на пиццы. Максимум 10.'], 400);
            }
        } elseif ($product->category_id === 2) {
            if ($currentDrinks + $newQuantity > self::MAX_DRINKS) {
                return response()->json(['message' => 'Превышен лимит на напитки. Максимум 20.'], 400);
            }
        }

        // Добавляем продукт в корзину
        $cartItem = CartItem::updateOrCreate(
            [
                'cart_id' => $request->cart_id,
                'product_id' => $request->product_id,
            ],
            [
                'quantity' => $newQuantity,
            ]
        );

        return response()->json(['message' => 'Продукт успешно добавлен в корзину.', 'cart_item' => $cartItem], 200);
    }
}
