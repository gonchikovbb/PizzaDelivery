<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'first_name' => 'required|string|max:255', // Обязательное поле, строка, максимум 255 символов
            'middle_name' => 'nullable|string|max:255', // Необязательное поле, строка, максимум 255 символов
            'email' => 'required|email|unique:users,email', // Обязательное поле, должно быть уникальным в таблице users
            'phone_number' => 'nullable|string|max:15', // Необязательное поле, строка, максимум 15 символов
            'password' => 'required|string|min:8|confirmed', // Обязательное поле, минимум 8 символов, должно совпадать с полем password_confirmation
            'birthdate' => 'nullable|date', // Необязательное поле, должно быть корректной датой
            'role_id' => 'required|exists:roles,id', // Обязательное поле, должно существовать в таблице roles
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'Имя обязательно для заполнения.',
            'email.required' => 'Email обязателен для заполнения.',
            'email.unique' => 'Этот email уже используется.',
            'password.required' => 'Пароль обязателен для заполнения.',
            'role_id.required' => 'Роль обязательна для заполнения.',
            'role_id.exists' => 'Выбранная роль не существует.',
        ];
    }
}
