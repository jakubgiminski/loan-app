<?php declare(strict_types=1);

namespace LoanApp\Service\Fee;

use LoanApp\Model\LoanApplication;

class FeeCalculator implements FeeCalculatorInterface
{
    public function calculate(LoanApplication $application): float
    {
        $term = $application->getTerm();
        $amount = $application->getAmount();

        if (FeeConfig::isValueAtThreshold($amount)) {
            return FeeConfig::getFee($term, $amount);
        }

        $previousThreshold = FeeConfig::getPreviousThreshold($amount);
        $previousThresholdFee = FeeConfig::getFee($term, $previousThreshold);
        $nextThreshold = FeeConfig::getNextThreshold($amount);
        $nextThresholdFee = FeeConfig::getFee($term, $nextThreshold);

        $fee = ($previousThresholdFee * ($nextThreshold - $amount) + $nextThresholdFee * ($amount - $previousThreshold))
            / ($nextThreshold - $previousThreshold);

        $reminder = fmod(($amount + $fee), 5);
        if ($reminder) {
            return round(5 - $reminder + $fee, 2);
        }

        return $fee;
    }
}
