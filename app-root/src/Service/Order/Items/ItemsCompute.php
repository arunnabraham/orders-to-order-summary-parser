<?php

namespace App\Service\Order\Items;

use App\Service\Money\MoneyCompute;
use App\Service\Pricing\Price;

class ItemsCompute
{
    private array $items;
    private array $discounts;

    private float $totalPrice;

    public function __construct(
        private readonly Price $price,
    ) {
    }

    public function setItemProperties(array $items, array $discounts): void
    {
        $this->items = $items;
        $this->discounts = $discounts;
    }

    private function getTotalPrice(): MoneyCompute
    {
        return $this->price->getTotalPrice(
            array_column($this->items, 'unit_price'),
            array_column($this->items, 'quantity')
        );
    }

    public function getFinalPrice(): MoneyCompute
    {
        return $this->price->getDiscountedPrice($this->getTotalPrice(), $this->discounts);
    }

    public function unitCount(): int
    {
        return array_sum(array_column($this->items, 'quantity'));
    }

    public function getAverageUnitPrice(): MoneyCompute
    {
        return $this->price->averageUnitPrice($this->getTotalPrice()->money(), $this->unitCount());
    }
}
