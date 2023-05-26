<?php

namespace App\Service\Order\Items;

use App\Service\Money\MoneyCompute;
use Money\Money;

readonly class ItemsCompute
{
    public function __construct(
        public array $items,
        public array $discount
    ) {
    }

    public function getTotalQuantities(): int
    {
        return array_sum(array_column($this->items, 'quantities'));
    }

    public function getTotalCartItems(): int
    {
        return count($this->items);
    }

    public function getTotalUnitPrice(): MoneyCompute
    {
        $priceMoney = array_map(function (mixed $price): Money {
            return (new MoneyCompute())->setAmount((string) $price)->getMoney();
        }, array_column($this->items, 'unit_price'));

        return (new MoneyCompute())->setMoney(
            (new MoneyCompute())
                ->getNewMoney()
                ->money()->add(...$priceMoney)
        );
    }

    public function getTotalDiscount()
    {
    }
}
