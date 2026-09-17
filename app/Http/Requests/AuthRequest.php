<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Override;

class AuthRequest extends BaseFormRequest
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
        $textRules = ['sometimes', 'required', 'string', 'max:255'];

        $passwordRules = ['required', 'string', 'max:255'];

        if ($this->filled('password_confirmation')) {
            $passwordRules[] = 'confirmed';
        }

        return [
            'email' => ['required', 'string', 'email'],
            'password' => $passwordRules,
            'password_confirmation' => $textRules,
            'name' => $textRules,
            'surname' => $textRules,
            'role' => $textRules,
            'tel' => $textRules,
        ];
    }

    #[Override]
    public function messages()
    {
        return [
            '*.required' => 'Dit veld is verplicht.',
            '*.string' => 'Ongeldige invoer',
            '*.max' => 'Dit veld mag maximaal 255 karakters bevatten.',
            '*.email' => 'Ongeldig emailadres.',
            'email.unique' => 'Er bestaat al een account met dit emailadres.',
            'password.confirmed' => 'De wachtwoorden komen niet overeen.',
        ];
    }
}
