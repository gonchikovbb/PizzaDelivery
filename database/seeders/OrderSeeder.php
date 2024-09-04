<?php

namespace Database\Seeders;

use App\Models\Address\Address;
use App\Models\Order\Order;
use App\Models\Order\OrderItem;
use App\Models\Product\Product;
use App\Models\User\User;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        // Получаем всех пользователей из базы данных
        $users = User::all();

        foreach ($users as $user) {
            // Получаем случайный адрес для пользователя
            $address = Address::inRandomOrder()->first();

            // Создаем заказ для каждого пользователя
            $order = Order::create([
                'user_id' => $user->id,
                'phone_number' => $user->phone_number, // Пример номера телефона
                'email' => $user->email,
                'address_id' => $address->id,
                'delivery_time' => now()->addHours(2)->format('H:i:s'), // Время доставки через 2 часа
                'status' => rand(0, 3),
            ]);

            // Получаем случайные продукты из базы данных
            $products = Product::inRandomOrder()->take(3)->get();

            foreach ($products as $product) {
                // Добавляем товары в заказ
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => rand(1, 5) // Случайное количество от 1 до 5
                ]);
            }
        }
    }
}
