<?php

namespace App\Service\Parser;

use Sunaoka\Ndjson\NDJSON as JSONL;

class OrderJSONLParser implements OrderParserInterface
{
    public function __construct(
        private readonly JSONL $jsonlParser
    ) {
    }

    public function parsed(): \Generator
    {
        try {
            while ($order = $this->jsonlParser->readline()) {
                yield $order;
            }
        } catch (\Throwable) {
        }
    }
}