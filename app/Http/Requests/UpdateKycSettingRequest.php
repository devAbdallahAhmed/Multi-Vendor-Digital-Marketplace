<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateKycSettingRequest extends FormRequest
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

    protected function prepareForValidation()
{
   $this->merge([
            'nid_verifications' => $this->has('nid_verifications') ? 1 : 0,
            'passport_verifications' => $this->has('passport_verifications') ? 1 : 0,
            'auto_approve' => $this->has('auto_approve') ? 1 : 0,
        ]);
}

    public function rules(): array
    {
       return [
            'nid_verifications' => ['nullable', 'boolean'],
            'passport_verifications' => ['nullable', 'boolean'], // شيلنا الكوتيشن الزيادة
            'instructions' => ['nullable', 'string', 'max:2000'],
            'auto_approve' => ['nullable', 'boolean'],
            'status' => ['required', 'boolean']
        ];
    }


}
