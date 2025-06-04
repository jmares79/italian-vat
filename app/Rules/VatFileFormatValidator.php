<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Http\UploadedFile;

class VatFileFormatValidator implements ValidationRule
{
    protected const FIRST_FILE_COLUMN = 'id';
    protected const SECOND_FILE_COLUMN = 'vat_number';
    protected const FILE_COLUMN_COUNT = 2;

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! $value instanceof UploadedFile) {
            $fail("The {$attribute} must be a valid file.");
            return;
        }
        $file = $value;

        $fp = fopen($file->getRealPath(), 'r');
        $header = fgetcsv($fp);

        if (! $header || count($header) < self::FILE_COLUMN_COUNT || $header[0] !== self::FIRST_FILE_COLUMN || $header[1] !== self::SECOND_FILE_COLUMN) {
            $fail("The {$attribute} file must have at least two columns in the header with the VAT id and Vat number.");
            return;
        }

        fclose($fp);
    }
}
