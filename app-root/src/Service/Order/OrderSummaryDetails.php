<?php

declare(strict_types=1);

namespace App\Service\Order;

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
    private ItemsCompute $computedCartItems;

    public function __construct(
        private readonly array $order
    ) {
        $this->computedCartItems = new ItemsCompute(
            $this->order[self::CART_KEY], $this->order[self::DISCOUNTS_KEY]
        );
        $this->setId();
        $this->setDate();
        $this->setTotalValue();
        $this->setAverageUnitPrice();
        $this->setUnitCount();
        $this->setCustomerState();
    }

    public function getData(): array
    {
        return $this->orderBrief;
    }

    private function setValues()
    {
    }

    private function setId(): void
    {
        $this->orderBrief[self::ID] = $this->order['order_id'];
    }

    private function setDate(): void
    {
        $this->orderBrief[self::DATE] = $this->order['order_datetime'];
    }

    private function setTotalValue(): void
    {
        $this->orderBrief[self::TOTAL_VALUE] = (float) $this->computedCartItems->getTotalUnitPrice()->getDecimal();
    }

    private function setAverageUnitPrice(): void
    {
        $this->orderBrief[self::AVERAGE_UNIT_PRICE] = 0;
    }

    private function setUnitCount(): void
    {
        $this->orderBrief[self::UNIT_COUNT] = 0;
    }

    private function setCustomerState(): void
    {
        $this->orderBrief[self::CUSTOMER_STATE] = $this->order['customer']['shipping_address']['state'];
    }
}
