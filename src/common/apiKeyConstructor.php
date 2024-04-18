<?php

namespace Ispahbod\SmsPanel\common;

trait apiKeyConstructor
{
    private string $apiKey;

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }
}