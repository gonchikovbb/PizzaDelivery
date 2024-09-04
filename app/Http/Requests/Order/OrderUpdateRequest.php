<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class OrderUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_id' => 'sometimes|exists:users,id', // Необязательное поле, должно существовать в таблице users
            'phone_number' => 'sometimes|string|max:15', // Необязательное поле, строка, максимум 15 символов
            'email' => 'sometimes|email', // Необязательное поле, должно быть корректным email
            'address_id' => 'sometimes|exists:addresses,id', // Необязательное поле, должно существовать в таблице addresses
            'delivery_time' => 'sometimes|required|date_format:H:i:s',// Обязательное поле, должно быть корректным временем
            'status' => 'sometimes|string|in:0,1,2,3', // Необязательное поле, строка, должно быть одним из указанных статусов
        ];
    }

    public function messages()
    {
        return [
            'user_id.exists' => 'Выбранный пользователь не существует.',
            'phone_number.string' => 'Номер телефона должен быть строкой.',
            'phone_number.max' => 'Номер телефона не может превышать 15 символов.',
            'email.email' => 'Email должен быть корректным.',
            'address_id.exists' => 'Выбранный адрес не существует.',
            'delivery_time.date' => 'Время доставки должно быть корректным временем.',
            'status.in' => 'Статус должен быть одним из: 0,1,2,3.',
        ];
    }
}
