<?php

namespace App\Http\Requests\Front;

use Illuminate\Foundation\Http\FormRequest;
use App\Services\NotificationService;

class PasswordRequest extends FormRequest
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
            'current_password' => 'required|string | current_password',
            'password' => 'required|string|min:8|confirmed|different:current_password',
            
        ];
    }

    public function withValidator($validator){

        if($validator->fails()){
             foreach($validator->errors()->all() as $error){
                NotificationService::error($error);
            }

        }

    }
}
