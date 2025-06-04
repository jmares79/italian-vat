<?php

namespace App\Http\Requests;

use App\Rules\VatFileFormatValidator;
use Illuminate\Foundation\Http\FormRequest;

class FileUploadRequest extends FormRequest
{
    public function prepareForValidation()
    {
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
            'file' => [
                'bail',
                'required',
                'file',
                'mimetypes:xlsx,xls,text/csv',
                'max:5120',
                new VatFileFormatValidator()
            ]
        ];
    }
}
