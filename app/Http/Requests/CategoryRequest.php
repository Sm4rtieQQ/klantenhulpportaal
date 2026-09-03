<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Override;

class CategoryRequest extends BaseFormRequest
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
            'name' => ['required', 'unique:categories,name'],
        ];
    }

    #[Override]
    public function messages()
    {
        return [
            'name.required' => 'A.u.b. naam van de categorie invullen.',
            'name.unique' => 'Categorie bestaat al.',
        ];
    }
}
