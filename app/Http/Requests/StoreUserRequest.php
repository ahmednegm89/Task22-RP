<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'email' => 'required|email|max:50|unique:users',
            'phone' => 'required|min:11|unique:users',
            'password' => 'required|min:8|max:50',
            'img' => 'required|image|mimes:jpeg,jpg,png|max:3072',
            'role' => 'required',
        ];
    }
}
