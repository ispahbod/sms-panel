<?php

namespace Ispahbod\SmsPanel\common;

trait responseConstructorTrait
{
    private array $response;
    private array $statusCode;
    private string $error;

    public function __construct(array $response, $statusCode = 200, $error = '')
    {
        $this->response = $response;
        $this->statusCode = $statusCode;
        $this->error = $error;
    }
}