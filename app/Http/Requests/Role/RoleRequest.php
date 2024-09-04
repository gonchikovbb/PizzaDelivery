<?php

namespace App\Http\Requests\Role;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:roles,name', // Поле name обязательно, должно быть строкой, уникальным и не превышать 255 символов
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Название роли обязательно.',
            'name.string' => 'Название роли должно быть строкой.',
            'name.max' => 'Название роли не должно превышать 255 символов.',
            'name.unique' => 'Эта роль уже существует.',
        ];
    }
}
