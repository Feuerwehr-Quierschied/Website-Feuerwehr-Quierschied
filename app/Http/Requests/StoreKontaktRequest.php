<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreKontaktRequest extends FormRequest
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
            'name' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'email'],
            'telefon' => ['nullable', 'string', 'max:50'],
            'empfaenger' => [
                'required',
                Rule::in(array_keys(config('contact.recipients'))),
            ],
            'nachricht' => ['required', 'string', 'max:5000'],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'name' => 'Name',
            'email' => 'E-Mail',
            'telefon' => 'Telefonnummer',
            'empfaenger' => 'Ansprechpartner',
            'nachricht' => 'Nachricht',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'email.required' => 'Bitte geben Sie Ihre E-Mail-Adresse an.',
            'email.email' => 'Bitte geben Sie eine gültige E-Mail-Adresse ein.',
            'empfaenger.required' => 'Bitte wählen Sie einen Ansprechpartner aus.',
            'empfaenger.in' => 'Bitte wählen Sie einen gültigen Ansprechpartner aus.',
            'nachricht.required' => 'Bitte geben Sie Ihre Nachricht ein.',
        ];
    }
}
