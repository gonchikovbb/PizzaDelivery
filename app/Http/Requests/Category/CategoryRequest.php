<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255', // Поле name обязательно, должно быть строкой и не превышать 255 символов
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Название категории обязательно.',
            'name.string' => 'Название категории должно быть строкой.',
            'name.max' => 'Название категории не должно превышать 255 символов.',
        ];
    }
}
