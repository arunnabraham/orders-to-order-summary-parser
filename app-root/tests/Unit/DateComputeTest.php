<?php

namespace App\Tests\Unit;

use App\Service\Date\DateCompute;
use App\Service\Date\DateComputeuse;
use PHPUnit\Framework\TestCase;

class DateComputeTest extends TestCase
{
    public function testFormattedIsValid()
    {
        $dateFormatter = (new DateCompute());

        foreach ($this->inputDatesAndFormats() as $dateParams)
        {
            [$dateInput, $outputFormat, $inputFormat] = $dateParams;
            $outputDate = $dateFormatter->toFormat($dateInput, $outputFormat, $inputFormat);

            $this->assertIsString($outputDate, 'Invalid date');
            $this->assertNotNull($outputDate);
        }
    }

    private function inputDatesAndFormats()
    {
        return [
            [
                '2017-09-19',
                'Y-m-d H:i:s',
                'Y-m-d',
            ],
            [
                '2018-10-11 12:12:00',
                'Y-m-d',
                'Y-m-d H:i:s',
            ],
            [
                '2018-10-11T12:12:00Z',
                'Y-m-d H:i:s',
                'Y-m-d\TH:i:s\Z',
            ]
        ];
    }

}