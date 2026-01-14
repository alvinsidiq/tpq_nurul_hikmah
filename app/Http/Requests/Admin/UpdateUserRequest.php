<?php

namespace App\Http\Requests\Admin;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()?->can('update', $this->route('user')) ?? false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id = $this->route('user')->id;
        return [
            'name' => 'required|string|max:120',
            'email' => "required|email|unique:users,email,$id",
            'phone' => 'nullable|string|max:30',
            'status' => 'required|in:active,inactive',
            'alamat' => 'nullable|string',
            'foto' => 'nullable|image|max:2048',
            'role' => 'required|in:admin,guru,wali_santri',
            'password' => 'nullable|min:8|confirmed',
        ];
    }
}
