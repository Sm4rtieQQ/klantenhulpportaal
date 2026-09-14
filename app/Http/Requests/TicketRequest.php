<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class TicketRequest extends FormRequest
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
            'title' => ['required', 'min:6', 'max:255'],
            'body' => ['required'],
            'status' => ['required', 'integer',],
            'created_by_id' => ['sometimes', 'integer'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Dit veld is verplicht.',
            'title.min' => 'Dit veld moet ten minste 6 karakters bevatten.',
            'title.max' => 'Dit veld mag maximaal 255 karakters bevatten.',
            'body.required' => 'Dit veld is verplicht.',
            'created_by_id' => 'Foutieve invoer.',
        ];
    }
}
