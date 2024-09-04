<?php

namespace Database\Seeders;

use App\Models\Cart\Cart;
use App\Models\Cart\CartItem;
use App\Models\Product\Product;
use App\Models\User\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CartSeeder extends Seeder
{
    public function run(): void
    {
        // Получаем всех пользователей из базы данных
        $users = User::all();

        foreach ($users as $user) {
            // Создаем корзину для каждого пользователя
            $cart = Cart::create(['user_id' => $user->id]);

            // Получаем случайные продукты из базы данных
            $products = Product::inRandomOrder()->take(3)->get();

            foreach ($products as $product) {
                // Добавляем товары в корзину
                CartItem::create([
                    'cart_id' => $cart->id,
                    'product_id' => $product->id,
                    'quantity' => rand(1, 5) // Случайное количество от 1 до 5
                ]);
            }
        }
    }
}
