<?php

namespace App\Service\Pricing;

use App\Service\Money\MoneyCompute;
use Money\Money;

class Price
{
    public function __construct(
        private Discount $discount,
        private MoneyCompute $moneyCompute
    ) {
    }

    public function getTotalPrice(array $unitPrices, array $quantities): MoneyCompute
    {
        $priceMoney = array_map(function (mixed $price, int $quantity): Money {
            return (new MoneyCompute())->setAmount($price)->money()->multiply($quantity);
        }, $unitPrices, $quantities);

        return $this->moneyCompute->setMoney(
            (new MoneyCompute())
                ->getNewMoney()
                ->money()->add(...$priceMoney)
        );
    }

    public function getDiscountedPrice(MoneyCompute $moneyCompute, array $discounts): MoneyCompute
    {
        return $this->moneyCompute->setMoney($moneyCompute->money()->subtract(
            $this->discount->getTotalDiscount(
                $moneyCompute->money(),
                $discounts
            )
        ));
    }

    public function averageUnitPrice(Money $totalPrice, int $totalQuantities): MoneyCompute
    {
        return $this->moneyCompute->setMoney($totalPrice->divide($totalQuantities));
    }
}
