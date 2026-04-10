<?php

namespace App\Http\Requests\Api\Front;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'avatar'=> 'nullable|max:2024|image',
             'email'=>['required', 'email', 'unique:users,email'],
            'country'=> 'required|string|max:255',
            'city'=> 'nullable|string|max:255',
            'address'=> 'required|string|max:255',

        ];
    }
}
  
 