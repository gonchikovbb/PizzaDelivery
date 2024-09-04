<?php

namespace Database\Seeders;

use App\Models\Category\Category;
use App\Models\Product\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductAndCategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::create(['name' => 'Пиццы']);
        Category::create(['name' => 'Напитки']);

        $categoryPizzaId = Category::where('name', 'Пиццы')->first()->id;
        $categoryDrinkId = Category::where('name', 'Напитки')->first()->id;

        // Создание продуктов вручную
        Product::create([
            'name' => 'Гавайская',
            'description' => 'С ананасом',
            'price' => 300.00,
            'category_id' => $categoryPizzaId,
        ]);

        Product::create([
            'name' => 'Бургерная',
            'description' => 'Соус бургера',
            'price' => 350.00,
            'category_id' => $categoryPizzaId,
        ]);

        Product::create([
            'name' => 'Пэпси',
            'description' => 'Пэпси кола 1.5 л',
            'price' => 100.00,
            'category_id' => $categoryDrinkId,
        ]);

        Product::create([
            'name' => 'Холодный чай',
            'description' => 'Со вкусом шиповника  1 л',
            'price' => 120.00,
            'category_id' => $categoryDrinkId,
        ]);
    }
}
