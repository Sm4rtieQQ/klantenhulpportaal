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
        return [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ];
    }

    #[Override]
    public function messages()
    {
        return [
            'email.required' => 'A.u.b. email adres invullen.',
            'email.email' => 'Email adres ongeldig.',
            'password.required' => 'A.u.b. wachtwoord invullen.'
        ];
    }
}
