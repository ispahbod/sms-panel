<?php

namespace Ispahbod\SmsPanel\panels\SmsIr;

use Ispahbod\SmsPanel\common\apiKeyConstructorTrait;

class SmsIr
{
    use apiKeyConstructorTrait;

    public function pattern(): Pattern
    {
        return new Pattern($this->apiKey);
    }
}