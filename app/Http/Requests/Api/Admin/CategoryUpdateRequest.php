<?php

namespace App\Http\Requests\Api\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CategoryUpdateRequest extends FormRequest
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
            'icon' => 'string|sometimes|max:50',
            'name' => 'sometimes|string|max:255|unique:categories,name,' . $this->category->id,
            'file_types' => 'sometimes|string|max:255',
            'show_at_nav'      => 'nullable|boolean',
            'show_at_featured' => 'nullable|boolean',
        ];
    }
}
