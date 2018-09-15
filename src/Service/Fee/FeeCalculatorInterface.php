<?php declare(strict_types=1);

namespace LoanApp\Service\Fee;

use LoanApp\Model\LoanApplication;

interface FeeCalculatorInterface
{
    public function calculate(LoanApplication $application): float;
}