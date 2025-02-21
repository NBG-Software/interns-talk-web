<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class ChangePasswordRequest extends FormRequest
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
            "old_password" => 'required',
            'new_password' => [
                'required',
                Password::min(8)->mixedCase()->numbers(),
                'regex:/^[a-zA-Z0-9]+$/',
                Rule::notIn([$this->input('old_password')]) // Ensure new password is different from old
            ],
        ];
    }
}
