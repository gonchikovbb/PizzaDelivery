<?php

namespace App\Http\Requests\Cart;

use Illuminate\Foundation\Http\FormRequest;

class CartItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Получите правила валидации, которые должны применяться к запросу.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'cart_id' => 'required|exists:carts,id', // Проверка, что корзина существует
            'product_id' => 'required|exists:products,id', // Проверка, что продукт существует
            'quantity' => 'required|integer|min:1', // Проверка, что количество больше 0
        ];
    }

    /**
     * Получите сообщения об ошибках валидации.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'cart_id.required' => 'Поле cart_id обязательно для заполнения.',
            'cart_id.exists' => 'Корзина с указанным ID не найдена.',
            'product_id.required' => 'Поле product_id обязательно для заполнения.',
            'product_id.exists' => 'Продукт с указанным ID не найден.',
            'quantity.required' => 'Поле quantity обязательно для заполнения.',
            'quantity.integer' => 'Количество должно быть целым числом.',
            'quantity.min' => 'Количество должно быть больше 0.',
        ];
    }
}
