<?php

namespace App\Logic\Factory;

use App\Enums\VatTypes;
use App\Interfaces\VatProcessingStrategyInterface;
use App\Logic\Strategies\ItalianVatStrategy;

class VatStrategyFactory
{
    public static function make(string $type): VatProcessingStrategyInterface
    {
        return match ($type) {
            VatTypes::ITALIAN => new ItalianVatStrategy(),
            default => new ItalianVatStrategy(),
        };
    }
}
