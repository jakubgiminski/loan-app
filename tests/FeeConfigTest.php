<?php declare(strict_types=1);

namespace LoanApp\Tests;

use LoanApp\Service\Fee\FeeConfig;
use PHPUnit\Framework\TestCase;

final class FeeConfigTest extends TestCase
{
    public function testCanCheckIfValueIsAtThreshold(): void
    {
        self::assertTrue(
            FeeConfig::isValueAtThreshold(1000.0)
        );
    }

    public function testCanCheckIfValueIsNotAtThreshold(): void
    {
        self::assertFalse(
            FeeConfig::isValueAtThreshold(1001.0)
        );
    }

    public function testCanGetPreviousThreshold(): void
    {
        self::assertEquals(
            9000,
            FeeConfig::getPreviousThreshold(9900)
        );
    }

    public function testCanGetNextThreshold(): void
    {
        self::assertEquals(
            10000, FeeConfig::getNextThreshold(9100)
        );
    }

    public function testCanGetFeeForTermAndThreshold(): void
    {
        self::assertEquals(
            140,
            FeeConfig::getFee(12, 7000)
        );
    }
}
