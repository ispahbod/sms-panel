<?php

namespace Ispahbod\SmsPanel;

use Ispahbod\SmsPanel\panels\LimoSms\LimoSms;
use Ispahbod\SmsPanel\panels\Mediana\Mediana;
use Ispahbod\SmsPanel\panels\Melipayamak\Melipayamak;
use Ispahbod\SmsPanel\panels\SmsIr\SmsIr;

class SmsPanel
{
    public static function melipayamak(string $apiKey): Melipayamak
    {
        return new Melipayamak($apiKey);
    }

    public static function mediana(string $apiKey): Mediana
    {
        return new Mediana($apiKey);
    }

    public static function smsir(string $apiKey): SmsIr
    {
        return new SmsIr($apiKey);
    }

    public static function limosms(string $apiKey): LimoSms
    {
        return new LimoSms($apiKey);
    }
}