<?php

namespace App\Service\Parser;

interface OrderParserInterface
{
    public function parsed(): \Generator;
}