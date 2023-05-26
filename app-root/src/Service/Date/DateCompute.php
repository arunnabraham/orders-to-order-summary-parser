<?php

declare(strict_types=1);

namespace App\Service\Date;

readonly class DateCompute
{
    public function toFormat(
        string $dateTime,
        string $outputFormat = 'Y-m-d H:i:s',
        string $inputFormat = 'Y-m-d\TH:i:s\Z'
    ): string|null {
        $dateObject = \DateTimeImmutable::createFromFormat($inputFormat, $dateTime);
        if ($dateObject instanceof \DateTimeInterface) {
            return $dateObject->format($outputFormat);
        }

        return null;
    }
}
