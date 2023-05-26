<?php

declare(strict_types=1);

namespace App\Service;

use App\Service\Order\OrderSummaryDetails;
use App\Service\Parser\OrderParserInterface;

class OrderSummary
{
    private array $orderRecords = [];

    public function __construct(
        private readonly OrderParserInterface $orderParser
    ) {
    }

    public function generateOrderRecords(): array
    {
        foreach ($this->orderParser->parsed() as $orderData) {
            $this->orderRecords[] = $this->extractSummary($orderData);
        }

        return $this->orderRecords;
    }

    private function extractSummary(array $order): array
    {
        return (new OrderSummaryDetails($order))->getData();
    }

    private function getOrderDate(string $dateTime, string $outputFormat = 'Y-m-d H:i:s', string $inputFormat = 'Y-m-d\TH:i:s\Z'): string|null
    {
        $dateObject = \DateTimeImmutable::createFromFormat($inputFormat, $dateTime);
        if ($dateObject instanceof \DateTimeInterface) {
            return $dateObject->format($outputFormat);
        }

        return null;
    }

    private function orderTotalPrice(array $items, array $discounts): float
    {
        $IndividualPrices = array_map([$this, 'individualPrice'], array_column($items, 'quantity'), array_column($items, 'unit_price'));

        return $this->finalPriceWithDiscount($IndividualPrices, $discounts);
    }

    private function individualPrice(int $quantity, float $unitPrice): float
    {
        return $quantity * $unitPrice;
    }

    private function finalPriceWithDiscount(array $individualPrices, array $discounts)
    {
        $totalPrice = array_sum($individualPrices);

        return $totalPrice - $this->discountCalculate($discounts, $totalPrice);
    }

    private function discountCalculate(array $discounts, float $totalPrice): float
    {
        $totalDiscount = 0;
        foreach ($discounts as $discount) {
            $totalDiscount += match ($discount['type']) {
                'PERCENT' => $this->percentageToUnit($totalPrice, $discount['value']),
                default => $discount['value']
            };
        }

        return $totalDiscount;
    }

    private function percentageToUnit(float $amount, float $percentValue): float
    {
        return $amount * $percentValue / 100;
    }

    private function totalUnits(array $itemsCart): int
    {
        $totalUnits = 0;

        foreach ($itemsCart as $item) {
            $totalUnits += $item['quantity'];
        }

        return $totalUnits;
    }

    private function averageUnitPrice(array $itemsCart): int
    {
        $averagePrice = 0;
        foreach ($itemsCart as $item) {
            $totalUnits += 0;
        }

        return $totalUnits;
    }
}