<?php

namespace Database\Factories\Order;

use App\Models\Address\Address;
use App\Models\Order\Order;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(), // Генерация пользователя
            'phone_number' => "1234567890",
            'email' => $this->faker->unique()->safeEmail,
            'address_id' => Address::factory(), // Генерация адреса
            'delivery_time' => $this->faker->time(),
            'status' => rand(0, 3),
        ];
    }
}
