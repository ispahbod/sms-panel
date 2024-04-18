<?php

namespace Ispahbod\SmsPanel\panels\LimoSms;

use Ispahbod\HttpManager\HttpManager;
use Ispahbod\PhoneManager\PhoneManager;
use Ispahbod\SmsPanel\common\apiKeyConstructorTrait;

class Pattern
{
    use apiKeyConstructorTrait;

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
        if (PhoneManager::isValidIranianNumber($receiver)){
            $this->receiver = PhoneManager::formatNumberLocal($receiver);
        }
        return $this;
    }

    public function execute(): ResponseHandler
    {
        if (empty($this->data) || empty($this->sender) || empty($this->receiver)) {
            $errorMessage = 'Data, sender, or receiver cannot be empty.';
            return new ResponseHandler(response: [], statusCode: 400, error: $errorMessage);
        }

        $http = new HttpManager();
        $url = 'https://api.limosms.com/api/sendpatternmessage';
        $request = $http->executeSingleRequest('post', $url, [
            'headers' => [
                'ApiKey' => $this->apiKey
            ],
            'json' => [
                'OtpId' => $this->id,
                'ReplaceToken' => $this->data,
                'SenderNumber' => $this->sender,
                'MobileNumber' => $this->receiver,
            ],
            'verify' => false
        ]);
        $array = $request->getContentArray();
        $data = empty($array) ? [] : $array;
        return new ResponseHandler(response: $data, statusCode: $request->getStatusCode(), error: $request->getBody());
    }
}