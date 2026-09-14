<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $textRules = ['required', 'string', 'max:255'];

        return [
            'name' => $textRules,
            'surname' => $textRules,
            'email' => [...$textRules, 'email'],
            'role' => $textRules,
            'tel' => $textRules,
            'admin' => ['required', 'boolean'],
        ];
    }
}
