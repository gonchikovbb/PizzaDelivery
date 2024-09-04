<?php

namespace App\Http\Requests\Cart;

use Illuminate\Foundation\Http\FormRequest;

class CartRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_id' => 'required|exists:users,id', // Обязательное поле, должно существовать в таблице users
        ];
    }

    public function messages()
    {
        return [
            'user_id.required' => 'Поле user_id обязательно для заполнения.',
            'user_id.exists' => 'Выбранный пользователь не существует.',
        ];
    }
}
