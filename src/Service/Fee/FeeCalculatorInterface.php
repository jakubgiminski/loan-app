<?php

declare(strict_types=1);

namespace Lendable\Interview\Interpolation\Service\Fee;

use Lendable\Interview\Interpolation\Model\LoanApplication;

/**
 * Calculates fees for loan applications.
 */
interface FeeCalculatorInterface
{
    /**
     * Calculates the fee for a loan application.
     *
     * @param LoanApplication $application The loan application to
     * calculate for.
     *
     * @return float The calculated fee.
     */
    public function calculate(LoanApplication $application): float;
}
