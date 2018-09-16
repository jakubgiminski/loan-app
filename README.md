# Insurance App

## Project objectives
Implement `FeeCalculatorInterface` such that it fulfills the fee structure below.
The fee structure does not follow a formula.

Values in between the breakpoints should be interpolated linearly between
the lower bound and upper bound that they fall between. The fee should then be
"rounded up" such that (fee + loan amount) is an exact multiple of 5.

The minimum amount for a loan is £1,000, and the maximum is £20,000.
You can assume values will always be within this range but they may be any value
up to 2 decimal places.
The term can be either 12 or 24 (number of months), you can als o
assume values will always be within this set.

Provide a test suite verifying your solution, use any testing framework
you feel comfortable with. Use any libraries (or none) you feel add value
to your solution.

## Required software 
```
php7.1 or higher
```

## Install dependencies 
```
composer install
```

## Run tests
```
vendor/bin/phpunit tests --colors --testdox
```

## Execute example
```
php example/use_case.php
```

## Api Documentation
```php
LoanApp\Service\FeeCalculator::calculateFee(
    LoanApp\Model\LoanApplication $application
): bool
```