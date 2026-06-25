<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class ItemUpdateRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'category' => ['required', 'exists:categories,id'],
            'sub_category' => ['required', 'exists:sub_categories,id'],
            'version' => ['nullable', 'string', 'max:20'],
            'demo_link' => ['nullable', 'url'],
            'tags' => ['required', 'array'],
            'tags.*' => ['string'],
            'preview_type' => ['nullable', 'in:image,video,audio'],
            'preview_image' => ['nullable' ,'string','max:255'],
            'preview_video' => ['nullable' ,'string','max:255'],
            'preview_audio' => ['nullable' ,'string','max:255'],
            'source_type' => ['nullable', 'in:upload,link'],
            'upload_source' => ['required_if:source_type,upload', 'nullable', 'string'],
            'link_source' => ['required_if:source_type,link', 'nullable', 'string'],
            'screenshots' => ['nullable', 'array'],
            'screenshots.*' => ['string'],
            'support' => ['required', 'in:0,1'],
            'support_instruction' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:1'],
            'discount_price' => ['nullable', 'numeric', 'min:0', 'lt:price'],
            'is_free' => ['required', 'in:0,1'],
            'message_for_reviewer' => ['nullable', 'string', 'max:1000']
        ];
    }
}
