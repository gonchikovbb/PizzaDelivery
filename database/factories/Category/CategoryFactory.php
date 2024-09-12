<?php

namespace Database\Factories\Category;

use App\Models\Category\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition()
    {
        return [
            'name' => $this->faker->randomElement(['Пицца', 'Напитки']), // Генерирует случайные категории
        ];
    }
}
