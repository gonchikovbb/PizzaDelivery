<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'email' => 'required|email|unique:users,email,' . $this->user->id, // Обязательное поле, должно быть уникальным, исключая текущего пользователя
            'phone_number' => 'nullable|string|max:15', // Необязательное поле, строка, максимум 15 символов
            'password' => 'nullable|string|min:8', // Необязательное поле, минимум 8 символов
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
            'password.min' => 'Пароль должен содержать минимум 8 символов.',
            'role_id.required' => 'Роль обязательна для заполнения.',
            'role_id.exists' => 'Выбранная роль не существует.',
        ];
    }
}
