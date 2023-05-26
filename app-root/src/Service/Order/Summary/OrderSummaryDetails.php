<?php

declare(strict_types=1);

namespace App\Service\Order\Summary;

use App\Service\Date\DateCompute;
use App\Service\Order\Items\ItemsCompute;

final class OrderSummaryDetails
{
    public const ID = 'order_id';
    public const DATE = 'order_date';
    public const TOTAL_VALUE = 'total_order_value';
    public const AVERAGE_UNIT_PRICE = 'average_unit_price';
    public const UNIT_COUNT = 'unit_count';
    public const CUSTOMER_STATE = 'customer_state';

    public const CART_KEY = 'items';

    public const DISCOUNTS_KEY = 'discounts';
    private array $orderBrief = [];

    private array $orderData;

    public function __construct(
        private readonly ItemsCompute $computedCartItems,
    ) {
    }

    public function getData(): array
    {
        return $this->orderBrief;
    }

    public function setOrderData(array $orderData): self
    {
        $this->orderData = $orderData;
        $this->computedCartItems->setItemProperties(
            $this->orderData[self::CART_KEY],
            $this->orderData[self::DISCOUNTS_KEY]
        );
        $this->setId();
        $this->setDate();
        $this->setTotalValue();
        $this->setAverageUnitPrice();
        $this->setUnitCount();
        $this->setCustomerState();

        return $this;
    }

    private function setId(): void
    {
        $this->orderBrief[self::ID] = $this->orderData['order_id'];
    }

    private function setDate(): void
    {
        $this->orderBrief[self::DATE] = (new DateCompute())
                                        ->toFormat(
                                            $this->orderData['order_datetime'], 'Y-m-d'
                                        );
    }

    private function setTotalValue(): void
    {
        $this->orderBrief[self::TOTAL_VALUE] =
            (float) $this->computedCartItems
                ->getFinalPrice()
                ->getDecimal();
    }

    private function setAverageUnitPrice(): void
    {
        $this->orderBrief[self::AVERAGE_UNIT_PRICE] =
            (float) $this->computedCartItems
            ->getAverageUnitPrice()
            ->getDecimal();
    }

    private function setUnitCount(): void
    {
        $this->orderBrief[self::UNIT_COUNT] = $this->computedCartItems->unitCount();
    }

    private function setCustomerState(): void
    {
        $this->orderBrief[self::CUSTOMER_STATE] = $this->orderData['customer']['shipping_address']['state'];
    }
}
