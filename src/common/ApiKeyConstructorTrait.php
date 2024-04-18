<?php

namespace Ispahbod\SmsPanel\common;

trait ApiKeyConstructorTrait
{
    private string $apiKey;

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }
}