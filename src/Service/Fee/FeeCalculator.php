<?php

declare(strict_types=1);

namespace Lendable\Interview\Interpolation\Service\Fee;

use Lendable\Interview\Interpolation\Model\LoanApplication;

class FeeCalculator implements FeeCalculatorInterface
{
    public function calculate(LoanApplication $application): float
    {
        $term = $application->getTerm();
        $amount = $application->getAmount();

        if (FeeConfig::isTreshold($amount)) {
            return FeeConfig::getFee($term, $amount);
        }

        $previousTreshold = FeeConfig::getPreviousTreshold($amount);
        $previousTresholdFee = FeeConfig::getFee($term, $previousTreshold);
        $nextTreshold = FeeConfig::getNextTreshold($amount);
        $nextTresholdFee = FeeConfig::getFee($term, $nextTreshold);

        $fee = ($previousTresholdFee * ($nextTreshold - $amount) + $nextTresholdFee * ($amount - $previousTreshold))
            / ($nextTreshold - $previousTreshold);

        return $this->roundUpFee($amount, $fee);
    }

    private function roundUpFee(float $amount, float $fee): float
    {
        $reminder = fmod(($amount + $fee), 5);
        if (!$reminder) {
            return $fee;
        }
        return round(5 - $reminder + $fee, 2);
    }
}
