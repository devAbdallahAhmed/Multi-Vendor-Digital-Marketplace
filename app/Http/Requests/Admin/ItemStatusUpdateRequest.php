<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Services\NotificationService;

class ItemStatusUpdateRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'status' => ['required', 'in:approved,soft_reject,hard_reject'],
            'reason' => ['required_if:status,soft_reject,hard_reject', 'nullable', 'string', 'max:5000'],
        ];
    }

    /**
     * Handle a failed validation attempt and trigger toaster alert.
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->all();
        $notificationService = app(NotificationService::class);

        foreach ($errors as $error) {
            $notificationService->error($error);
        }

        throw new HttpResponseException(redirect()->back()->withInput());
    }
}
