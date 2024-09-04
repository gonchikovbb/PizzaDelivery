<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255', // Название продукта обязательно, строка, максимум 255 символов
            'description' => 'nullable|string', // Описание продукта может быть пустым, строка
            'price' => 'required|numeric|min:0', // Цена продукта обязательна, должна быть числом и не меньше 0
            'category_id' => 'required|exists:categories,id', // category_id обязательна и должна существовать в таблице categories
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
