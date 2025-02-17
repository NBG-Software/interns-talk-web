<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;

class ProfileUpdateValidationRequest extends FormRequest
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
        Validator::extend('word_count', function ($attribute, $value, $parameters, $validator) {
            $wordCount = str_word_count($value);
            $min = $parameters[0] ?? 2;

            return $wordCount >= $min;
        });

        return [
            'name' => 'required|word_count:2',
            'email' => 'required|email',
            'expertise' => 'required',
            'company' => 'required',
        ];
    }


    public function messages(){
        return[
            'name.word_count' => "You should provide your full name.",
        ];
    }
}
