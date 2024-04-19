<?php

namespace Ispahbod\SmsPanel\panels\SmsIr;

use Ispahbod\HttpManager\HttpManager;
use Ispahbod\PhoneManager\PhoneManager;
use Ispahbod\SmsPanel\common\ApiKeyConstructorTrait;

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

    public function setReceiver(string $receiver): self
    {
        if (PhoneManager::isValidIranianNumber($receiver)) {
            $this->receiver = PhoneManager::formatNumberLocal($receiver);
        }
        return $this;
    }

    public function execute(): ResponseHandler
    {
        if (empty($this->data) ||  empty($this->receiver)) {
            $errorMessage = 'Data or receiver cannot be empty.';
            return new ResponseHandler(response: [], statusCode: 400, error: $errorMessage);
        }

        $http = new HttpManager();
        $url = 'https://api.sms.ir/v1/send/verify';
        $request = $http->executeSingleRequest('post', $url, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'text/plain',
                'x-api-key' => $this->apiKey,
            ],
            'json' => [
                'mobile' => $this->receiver,
                'templateId' => $this->id,
                'parameters' => array_map(function ($value, $key) {
                    return [
                        'name' => $key,
                        'value' => $value,
                    ];
                }, $this->data, array_keys($this->data)),
            ],
            'verify' => false
        ]);
        $array = $request->getContentArray();
        $data = empty($array) ? [] : $array;
        return new ResponseHandler(response: $data, statusCode: $request->getStatusCode(), error: $request->getBody());
    }
}
