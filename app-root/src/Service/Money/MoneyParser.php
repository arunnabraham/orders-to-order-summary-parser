<?php

namespace App\Service\Money;

use Money\Currencies\ISOCurrencies;
use Money\Currency;
use Money\Money;
use Money\Parser\DecimalMoneyParser;
readonly class MoneyParser
{
    public function __construct(
        private readonly string $currency
    ) {
    }

    public function parse(string $amount): Money
    {
        $moneyParser = new DecimalMoneyParser(new ISOCurrencies());

        return $moneyParser->parse($amount, new Currency($this->currency));
    }
}
