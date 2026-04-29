<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class RoleUserUpdateRequest extends FormRequest
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
   $roleUserId = $this->route('role_user');


    $id = ($roleUserId instanceof \Illuminate\Database\Eloquent\Model)
            ? $roleUserId->id
            : $roleUserId;
    return [
        'name' => 'sometimes|string|max:255',
        'email' => 'sometimes|email|unique:admins,email,' . $roleUserId,
        'password' => 'nullable|string|min:8|confirmed',
        'role_id' => [
            'sometimes',
            \Illuminate\Validation\Rule::exists('roles', 'id')->where(function ($query) {
                return $query->where('guard_name', 'admin');
            }),
        ]
    ];
}

}













