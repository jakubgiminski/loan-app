<?php
declare(strict_types=1);

namespace Lendable\Interview\Interpolation\Tests;

use PHPUnit\Framework\TestCase;
use Lendable\Interview\Interpolation\Service\Fee\FeeConfig;
use Lendable\Interview\Interpolation\Service\Fee\FeeCalculator;
use Lendable\Interview\Interpolation\Model\LoanApplication;

final class FeeCalculatorTest extends TestCase
{
    public function testGetsFeeIfAmountIsTreshold(): void
    {
        $calculator = new FeeCalculator();
        self::assertEquals(50, $calculator->calculate(new LoanApplication(12, 1000)));
    }

    public function testGetsFeeIfAmountIsBetweenTresholds(): void
    {
        $calculator = new FeeCalculator();
        self::assertEquals(70, $calculator->calculate(new LoanApplication(12, 1500)));
    }

    public function testRoundsFeeUpSoThatAmountPlusFeeAreDivisibleByFive(): void
    {
        $calculator = new FeeCalculator();
        $amount = 2745;
        $fee = $calculator->calculate(new LoanApplication(24, $amount));
        self::assertEquals(0, ($amount + $fee) % 5);
    }
}
