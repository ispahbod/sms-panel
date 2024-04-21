<?php

namespace Ispahbod\SmsPanel\panels\LimoSms;

use Ispahbod\SmsPanel\common\ApiKeyConstructorTrait;

class LimoSms
{
    use ApiKeyConstructorTrait;

    public function pattern(): Pattern
    {
        return new Pattern($this->apiKey);
    }
}