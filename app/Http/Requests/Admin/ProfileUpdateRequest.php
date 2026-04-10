<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins,email,' . auth()->guard('admin')->id(),
            // 'password' => 'nullable|string|confirmed|min:8'
            'address'=>'nullable|string|max:255',
            'city'=>'nullable|string|max:255',
            'country'=>'required|string|max:255',
            'about'=>'nullable|string|max:1000',
        ];
    }
}
