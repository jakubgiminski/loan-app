<?php
declare(strict_types=1);

namespace Lendable\Interview\Interpolation\Tests;

use PHPUnit\Framework\TestCase;
use Lendable\Interview\Interpolation\Service\Fee\FeeConfig;

final class FeeConfigTest extends TestCase
{
    public function testCanCheckIfValueIsTreshold(): void
    {
        self::assertTrue(FeeConfig::isTreshold(1000.0));
    }

    public function testCanCheckIfValueIsNotTreshold(): void
    {
        self::assertFalse(FeeConfig::isTreshold(1001.0));
    }

    public function testCanGetPreviousTreshold(): void
    {
        self::assertEquals(9000, FeeConfig::getPreviousTreshold(9900));
    }

    public function testCanGetNextTreshold(): void
    {
        self::assertEquals(10000, FeeConfig::getNextTreshold(9100));
    }

    public function testCanGetFeeForTermAndTreshold(): void
    {
        self::assertEquals(140, FeeConfig::getFee(12, 7000));
    }
}
