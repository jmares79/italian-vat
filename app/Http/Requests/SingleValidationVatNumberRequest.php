<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SingleValidationVatNumberRequest extends FormRequest
{
    public function prepareForValidation()
    {
        // Country code not used for now, fixed to ITALY
        if (! $this->has('country_code')) {
            $this->merge(['country_code' => 'IT']);
        }
    }

    public function rules(): array
    {
        return [
            'country_code' => [
                'bail',
                'required',
                'string',
                'size:2',
                'regex:/^[A-Z]{2}$/'
            ],
            'vat_number' => [
                'required',
                'string',
                'min:9',
                'max:13',
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'vat_number.required' => 'The VAT number is required.',
            'vat_number.string' => 'The VAT number must be a string.',
            'vat_number.min' => 'The VAT number must be at least 9 characters in order to be able to be fixed.',
            'vat_number.max' => 'The VAT number may not be greater than 11 characters.',
        ];
    }
}
