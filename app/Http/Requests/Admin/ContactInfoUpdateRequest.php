<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ContactInfoUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'phone_1' => 'nullable|string|max:255',
            'phone_2' => 'nullable|string|max:255',
            'email_1' => 'nullable|email|max:255',
            'email_2' => 'nullable|email|max:255',
            'link_1'  => 'nullable|string|max:255',
            'link_2'  => 'nullable|string|max:255',
            'map'     => 'nullable|string',
        ];
    }
}
