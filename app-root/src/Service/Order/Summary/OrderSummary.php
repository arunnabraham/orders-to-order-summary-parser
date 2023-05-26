<?php

declare(strict_types=1);

namespace App\Service\Order\Summary;

use App\Service\Parser\OrderParserInterface;

class OrderSummary
{
    private array $orderRecords = [];

    public function __construct(
        private readonly OrderParserInterface $orderParser,
        private readonly OrderSummaryDetails $orderSummaryDetails
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
        return $this->orderSummaryDetails->setOrderData($order)->getData();
    }
}
