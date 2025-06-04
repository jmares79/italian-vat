<?php

namespace Tests\Unit\Strategies;

use App\Logic\Strategies\ItalianVatStrategy;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class ItalianVatStrategyTest extends TestCase
{
    #[Test]
    #[DataProvider('vat_numbers')]
    public function it_process_italian_vat_numbers($number, $status, $processed): void
    {
        $strategy = new ItalianVatStrategy();

        $res = $strategy->process($number);
        $lastStatus = $strategy->getLastStatus();

        $this->assertEquals($processed, $res);
        $this->assertEquals($status, $lastStatus);
    }

    public static function vat_numbers(): array
    {
        return [
            'valid number' => ['IT12345678901', 'valid', 'IT12345678901'],
            'valid fixable number' => ['12345678901', 'fixed', 'IT12345678901'],
            'invalid insufficient digits' => ['IT1234567890', 'invalid', 'IT1234567890'],
            'invalid additional digits' => ['IT123456789012', 'invalid', 'IT123456789012'],
            'invalid not all digits numbers' => ['IT1234567890A', 'invalid', 'IT1234567890A'],
            'invalid all digits' => ['___sfaaaaa', 'invalid', '___sfaaaaa'],
        ];
    }
}
