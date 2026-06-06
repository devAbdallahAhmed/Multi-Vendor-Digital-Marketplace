<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class KycStoreRequest extends FormRequest
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
            'document_type'   => 'required|string|in:nid,passport',
            'document_number' => [
                'required',
                'string',
                'max:40',
                'unique:kyc_verifications,document_number'
            ],
            'documents.*'     => 'required|file|mimes:jpeg,png,jpg,pdf|max:2048'
        ];
    }
}
