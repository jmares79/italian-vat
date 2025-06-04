<?php

namespace App\Logic\Strategies;

use App\Interfaces\VatProcessingStrategyInterface;

class ItalianVatStrategy implements VatProcessingStrategyInterface
{
    protected const VALID_VAT_REGEX = '/^IT\d{11}$/';
    protected const FALLBACK_VAT_REGEX = '/\d{11}$/';
    protected const COUNTRY_CODE = 'IT';
    protected string $lastStatus;
    protected string $lastOperationPerformed;

    public function getLastStatus(): string
    {
        return $this->lastStatus;
    }

    public function getLastOperationPerformed(): string
    {
        return $this->lastOperationPerformed;
    }

    /**
     * Process the VAT number according to Italian format.
     *
     * @param string $vatNumber
     * @return mixed It returns the VAT number as it is if valid or invalid, or a fixed version if possible,
     *  setting the last status accordingly.
     */
    public function process(string $vatNumber): mixed
    {
        $matches = [];
        $vatNumber = trim($vatNumber);

        // First I check if it's valid
        if (preg_match(self::VALID_VAT_REGEX, $vatNumber, $matches)) {
            $this->lastStatus = 'valid';
            $this->lastOperationPerformed = 'No operation needed, valid VAT number';

            return $vatNumber; // Return the valid VAT number as is
        }

        // Then if it's possible to be fixed
        if (preg_match(self::FALLBACK_VAT_REGEX, $vatNumber, $matches)) {
            $this->lastStatus = 'fixed';
            $this->lastOperationPerformed = 'Prefixing with country code IT';

            return self::COUNTRY_CODE . $matches[0]; // Prefix with IT for fallback
        }

        // Return the original VAT number if no match found
        $this->lastStatus = 'invalid';
        $this->lastOperationPerformed = 'The number cannot be fixed, as it is not at least a 9 valid digits long';

        return $vatNumber;
    }
}
