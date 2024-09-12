<?php

namespace Database\Factories\Address;

use App\Models\Address\Address;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    protected $model = Address::class;

    public function definition()
    {
        return [
            'title' => $this->faker->streetName, // Название адреса
            'city' => $this->faker->city, // Город
            'street' => $this->faker->streetAddress, // Улица
            'building' => $this->faker->buildingNumber, // Дом / Строение
            'floor' => $this->faker->optional()->numberBetween(1, 20), // Этаж (опционально)
            'room' => (string) $this->faker->optional()->numberBetween(1, 100), // Помещение (опционально, строка)
        ];
    }
}
