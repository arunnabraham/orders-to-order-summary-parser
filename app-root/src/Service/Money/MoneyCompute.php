<?php

namespace App\Service\Money;

use Money\Currencies\ISOCurrencies;
use Money\Formatter\DecimalMoneyFormatter;
use Money\Money;

class MoneyCompute
{
    private ?Money $money = null;

    public function setAmount(string $amount): self
    {
        $this->money = Money::USD((int) ((float) $amount * 100));

        return $this;
    }

    public function setMoney(Money $money): self
    {
        $this->money = $money;

        return $this;
    }

    public function money(): Money
    {
        return $this->money;
    }

    public function getNewMoney(): self
    {
        return $this->setAmount(0);
    }

    public function getDecimal(): string
    {
        return (new DecimalMoneyFormatter(new ISOCurrencies()))->format($this->money);
    }
}
