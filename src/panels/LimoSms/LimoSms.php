<?php

namespace Ispahbod\SmsPanel\panels\LimoSms;

use Ispahbod\SmsPanel\common\apiKeyConstructor;

class LimoSms
{
    use apiKeyConstructor;

    public function pattern(): Pattern
    {
        return new Pattern($this->apiKey);
    }
}