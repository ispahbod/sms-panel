<?php

namespace Ispahbod\SmsPanel\panels\LimoSms;

use Ispahbod\APIResponseBuilder\APIResponseBuilder;
use Ispahbod\SmsPanel\common\ResponseConstructorTrait;

class ResponseHandler
{
    use ResponseConstructorTrait;

    public function fetchStatusCode(): int
    {
        return $this->statusCode;
    }

    public function fetchErrorMessage(): string
    {
        return $this->error;
    }

    public function isRequestSuccessful(): bool
    {
        return isset($this->response['success']) && $this->response['success'] === true;
    }

    public function isRequestUnsuccessful(): bool
    {
        return !($this->isRequestSuccessful());
    }

    public function fetchResponseData(): array
    {
        if ($this->isRequestSuccessful()) {
            return json_decode(APIResponseBuilder::success(), true);
        }
        return json_decode(APIResponseBuilder::error(), true);
    }
}