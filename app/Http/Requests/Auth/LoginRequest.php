<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Получает правила валидации, которые должны применяться к запросу.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email', // Поле email обязательно и должно быть корректным
            'password' => 'required|string|min:8', // Поле password обязательно и должно быть строкой длиной не менее 8 символов
        ];
    }

    /**
     * Получает сообщения об ошибках валидации.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => 'Email обязателен.',
            'email.email' => 'Введите корректный адрес электронной почты.',
            'password.required' => 'Пароль обязателен.',
            'password.min' => 'Пароль должен содержать не менее 8 символов.',
        ];
    }
}
