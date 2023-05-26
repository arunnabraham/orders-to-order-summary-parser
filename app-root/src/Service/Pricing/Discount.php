<?php

namespace App\Service\Pricing;

use App\Service\Money\MoneyCompute;
use Money\Money;

readonly class Discount
{
    public function __construct(
        private MoneyCompute $moneyCompute
    ) {
    }

    public function getTotalDiscount(Money $inputAmount, $discounts): Money
    {
        return $this->moneyCompute->getNewMoney()->money()->add(
            ...array_map(
                function (string $discountType, float $value) use ($inputAmount) {
                    return match ($discountType) {
                        'PERCENT' => $inputAmount->multiply($value)->divide(100),
                        default => $this->moneyCompute->setAmount($value)->money()
                    };
                },
                array_column($discounts, 'type'),
                array_column($discounts, 'value')
            )
        );
    }
}
