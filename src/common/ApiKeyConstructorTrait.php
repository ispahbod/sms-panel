<?php

namespace Ispahbod\SmsPanel\common;

trait apiKeyConstructorTrait
{
    private string $apiKey;

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }
}