<?php

namespace App\Http\Requests\Address;

use Illuminate\Foundation\Http\FormRequest;

class AddressCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',  // Обязательное поле, строка, максимум 255 символов
            'city' => 'required|string|max:100',    // Обязательное поле, строка, максимум 100 символов
            'street' => 'required|string|max:100',  // Обязательное поле, строка, максимум 100 символов
            'building' => 'nullable|string|max:50', // Необязательное поле, строка, максимум 50 символов
            'floor' => 'nullable|integer|min:0',    // Необязательное поле, целое число, минимум 0
            'room' => 'nullable|string|max:50',      // Необязательное поле, строка, максимум 50 символов
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Поле title обязательно для заполнения.',
            'city.required' => 'Поле city обязательно для заполнения.',
            'street.required' => 'Поле street обязательно для заполнения.',
            'building.max' => 'Поле building может содержать максимум 50 символов.',
            'floor.min' => 'Поле floor должно быть не меньше 0.',
            'room.max' => 'Поле room может содержать максимум 50 символов.',
        ];
    }
}
