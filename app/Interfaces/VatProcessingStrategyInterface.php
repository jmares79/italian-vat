<?php

namespace App\Interfaces;

interface VatProcessingStrategyInterface
{
    public function process(string $vatNumber): mixed;
}
