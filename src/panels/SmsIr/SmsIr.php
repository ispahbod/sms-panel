<?php

namespace Ispahbod\SmsPanel\panels\SmsIr;

use Ispahbod\SmsPanel\common\ApiKeyConstructorTrait;

class SmsIr
{
    use ApiKeyConstructorTrait;

    public function pattern(): Pattern
    {
        return new Pattern($this->apiKey);
    }
}