<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class OrderCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            //'user_id' => 'required|exists:users,id', // Обязательное поле, должно существовать в таблице users
            'phone_number' => 'required|string|max:15', // Обязательное поле, строка, максимум 15 символов
            'email' => 'required|email', // Обязательное поле, должно быть корректным email
            'address_id' => 'required|exists:addresses,id', // Обязательное поле, должно существовать в таблице addresses
            'delivery_time' => 'required|date_format:H:i:s',// Обязательное поле, должно быть корректным временем
            //'status' => 'required|string|in:0,1,2,3', // Обязательное поле, строка, должно быть одним из указанных статусов
        ];
    }

    public function messages()
    {
        return [
            //'user_id.required' => 'ID пользователя обязателен для заполнения.',
            //'user_id.exists' => 'Выбранный пользователь не существует.',
            'phone_number.required' => 'Номер телефона обязателен для заполнения.',
            'email.required' => 'Email обязателен для заполнения.',
            'email.email' => 'Email должен быть корректным.',
            'address_id.required' => 'ID адреса обязателен для заполнения.',
            'address_id.exists' => 'Выбранный адрес не существует.',
            'delivery_time.required' => 'Время доставки обязательно для заполнения.',
            'delivery_time.date' => 'Время доставки должно быть корректным временем.',
            //'status.required' => 'Статус обязателен для заполнения.',
            //'status.in' => 'Статус должен быть одним из: 0,1,2,3.',
        ];
    }
}
