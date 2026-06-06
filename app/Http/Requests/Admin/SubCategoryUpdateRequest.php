<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SubCategoryUpdateRequest extends FormRequest
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
        // We used 'category' here because Laravel's apiResource names the parameter after the last segment
        $subCategoryId = $this->route('category')?->id ?? $this->route('category');

        return [
            'category_id' => [
                'sometimes',
                'integer',
                'exists:categories,id',
            ],
            'name' => [
                'sometimes',
                'string',
                'max:255',
                Rule::unique('categories', 'name')->ignore($subCategoryId),
            ],
        ];
    }
}
