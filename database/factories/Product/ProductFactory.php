<?php

namespace Database\Factories\Product;

use App\Models\Category\Category;
use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word, // Генерирует случайное название
            'description' => $this->faker->sentence, // Генерирует случайное описание
            'price' => $this->faker->randomFloat(2, 1, 100), // Генерирует случайную цену от 1 до 100
            'category_id' => Category::factory(), // Связывает с существующей категорией или создает новую
        ];
    }
}
