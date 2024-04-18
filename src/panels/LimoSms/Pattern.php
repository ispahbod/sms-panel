<?php

namespace Ispahbod\SmsPanel\panels\LimoSms;

use Ispahbod\HttpManager\HttpManager;
use Ispahbod\SmsPanel\common\apiKeyConstructor;

class Pattern
{
    use apiKeyConstructor;

    private string $id = '';
    private string $sender = '';
    private string $receiver = '';
    private array $data = [];

    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function setData(array $data): self
    {
        $this->data = $data;
        return $this;
    }

    public function setSender(string $sender): self
    {
        $this->sender = $sender;
        return $this;
    }

    public function setReceiver(string $receiver): self
    {
        $this->receiver = $receiver;
        return $this;
    }

    public function execute()
    {
        $http = new HttpManager();
        $url = 'https://api.limosms.com/api/sendpatternmessage';
        return $http->executeSingleRequest('post', $url, [
            'json' => [
                'OtpId' => $this->id,
                'ReplaceToken' => $this->data,
                'SenderNumber' => $this->sender,
                'MobileNumber' => $this->receiver,
            ],
            'verify' => false
        ])->getContent();
    }
}