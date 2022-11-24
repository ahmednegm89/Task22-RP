<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|min:8',
            'email' => "required|email|max:50|unique:users,email,$this->id",
            'phone' => "required|min:11|unique:users,phone,$this->id",
            'password' => '',
            'img' => '',
            'role' => 'required',
        ];
    }
}
