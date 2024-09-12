<?php

namespace Database\Factories\Cart;

use App\Models\Cart\Cart;
use App\Models\Cart\CartItem;
use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CartItem>
 */
class CartItemFactory extends Factory
{
    protected $model = CartItem::class;

    public function definition()
    {
        return [
            'cart_id' => Cart::factory(), // Создает корзину для элемента
            'product_id' => Product::factory(), // Создает продукт для элемента
            'quantity' => $this->faker->numberBetween(1, 10), // Случайное количество
        ];
    }
}
