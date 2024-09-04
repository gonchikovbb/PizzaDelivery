<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'sometimes|required|string|max:255', // Название продукта может быть обновлено, но не обязательно
            'description' => 'sometimes|nullable|string', // Описание продукта может быть обновлено, строка
            'price' => 'sometimes|required|numeric|min:0', // Цена продукта может быть обновлена, обязательна, должна быть числом и не меньше 0
            'category_id' => 'sometimes|required|exists:categories,id', // category_id может быть обновлена, обязательна и должна существовать в таблице categories
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Название продукта обязательно.',
            'price.required' => 'Цена продукта обязательна.',
            'category_id.required' => 'Категория продукта обязательна.',
            'category_id.exists' => 'Выбранная категория не существует.',
        ];
    }
}
