<?php declare(strict_types=1);

namespace LoanApp\Model;

class LoanApplication
{
    private $term;

    private $amount;

    public function __construct(int $term, float $amount)
    {
        $this->term = $term;
        $this->amount = $amount;
    }

    public function getTerm(): int
    {
        return $this->term;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }
}
