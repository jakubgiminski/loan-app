<?php declare(strict_types=1);

namespace LoanApp\Tests;

use LoanApp\Service\Fee\FeeConfig;
use PHPUnit\Framework\TestCase;

final class FeeConfigTest extends TestCase
{
    public function testCanCheckIfValueIsAtTreshold(): void
    {
        self::assertTrue(
            FeeConfig::isValueAtTreshold(1000.0)
        );
    }

    public function testCanCheckIfValueIsNotAtTreshold(): void
    {
        self::assertFalse(
            FeeConfig::isValueAtTreshold(1001.0)
        );
    }

    public function testCanGetPreviousTreshold(): void
    {
        self::assertEquals(
            9000,
            FeeConfig::getPreviousTreshold(9900)
        );
    }

    public function testCanGetNextTreshold(): void
    {
        self::assertEquals(
            10000, FeeConfig::getNextTreshold(9100)
        );
    }

    public function testCanGetFeeForTermAndTreshold(): void
    {
        self::assertEquals(
            140,
            FeeConfig::getFee(12, 7000)
        );
    }
}
