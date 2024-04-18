<?php

namespace Ispahbod\SmsPanel\panels\LimoSms;

use Ispahbod\SmsPanel\common\apiKeyConstructorTrait;

class LimoSms
{
    use apiKeyConstructorTrait;

    public function pattern(): Pattern
    {
        return new Pattern($this->apiKey);
    }
}