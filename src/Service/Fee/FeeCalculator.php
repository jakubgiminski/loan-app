<?php declare(strict_types=1);

namespace LoanApp\Service\Fee;

use LoanApp\Model\LoanApplication;

class FeeCalculator implements FeeCalculatorInterface
{
    public function calculate(LoanApplication $application): float
    {
        $term = $application->getTerm();
        $amount = $application->getAmount();

        if (FeeConfig::isValueAtTreshold($amount)) {
            return FeeConfig::getFee($term, $amount);
        }

        $previousTreshold = FeeConfig::getPreviousTreshold($amount);
        $previousTresholdFee = FeeConfig::getFee($term, $previousTreshold);
        $nextTreshold = FeeConfig::getNextTreshold($amount);
        $nextTresholdFee = FeeConfig::getFee($term, $nextTreshold);

        $fee = ($previousTresholdFee * ($nextTreshold - $amount) + $nextTresholdFee * ($amount - $previousTreshold))
            / ($nextTreshold - $previousTreshold);

        $reminder = fmod(($amount + $fee), 5);
        if ($reminder) {
            return round(5 - $reminder + $fee, 2);
        }

        return $fee;
    }
}
