<?php

namespace App\Logic;

use App\Logic\Factory\VatStrategyFactory;
use App\Models\Vat;
use Illuminate\Http\UploadedFile;

readonly class VatProcessingLogic
{
    public function __construct(protected VatStrategyFactory $factory) {}

    public function process(UploadedFile $file, string $countryCode, bool $skipFirstRow = true): void
    {
        $vatStrategy = $this->factory->make($countryCode);

        $fp = fopen($file->getRealPath(), 'r');

        if ($fp === false) {
            throw new \RuntimeException('Could not open file for reading.');
        }

        // Skip the first row if needed
        $skipFirstRow && fgetcsv($fp);

        // We will also process whatever header the file has, which will be invalid and not saved
        while (($row = fgetcsv($fp)) !== false) {
            if (! isset($row[0]) || ! isset($row[1])) {
                continue; // Skip invalid rows
            }

            $number = $vatStrategy->process($row[1]);
            $status = $vatStrategy->getLastStatus();

            // If the VAT number and country code already exist, skip it
            if (Vat::where('number', $number)->where('country_code', $countryCode)->exists()) {
                continue; // Skip if already processed
            }

            Vat::create([
                'custom_id' => $row[0], // The id is custom and not the VAT number and not validated
                'number' => $number,
                'country_code' => $countryCode,
                'is_valid' => $status === 'valid' || $status === 'fixed',
                'status' => $status,
            ]);
        }

        fclose($fp);
    }
}
