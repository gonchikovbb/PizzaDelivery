<?php

namespace Database\Factories\Order;

use App\Models\Order\Order;
use App\Models\Order\OrderItem;
use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderItemFactory extends Factory
{
    protected $model = OrderItem::class;

    public function definition()
    {
        return [
            'order_id' => Order::factory(), // Генерация заказа
            'product_id' => Product::factory(), // Генерация продукта
            'quantity' => $this->faker->numberBetween(1, 10), // Случайное количество
        ];
    }
}
