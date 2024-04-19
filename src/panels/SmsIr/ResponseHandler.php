<?php

namespace Ispahbod\SmsPanel\panels\SmsIr;

use Ispahbod\APIResponseBuilder\APIResponseBuilder;
use Ispahbod\SmsPanel\common\ResponseConstructorTrait;

class ResponseHandler
{
    use ResponseConstructorTrait;

    public function fetchStatusCode(): int
    {
        $statusCodesMap = [
            0 => 500, // Internal Server Error
            1 => 200, // OK
            10 => 401, // Unauthorized
            11 => 403, // Forbidden
            12 => 403, // Forbidden
            13 => 403, // Forbidden
            14 => 403, // Forbidden
            15 => 402, // Payment Required
            16 => 400, // Bad Request
            20 => 429, // Too Many Requests
            101 => 400, // Bad Request
            102 => 402, // Payment Required
            103 => 400, // Bad Request
            104 => 400, // Bad Request
            105 => 413, // Payload Too Large
            106 => 413, // Payload Too Large
            107 => 400, // Bad Request
            108 => 400, // Bad Request
            109 => 400, // Bad Request
            110 => 400, // Bad Request
            111 => 404, // Not Found
            112 => 404, // Not Found
            113 => 404, // Not Found
            114 => 400, // Bad Request
            115 => 403, // Forbidden
            116 => 400, // Bad Request
            117 => 403, // Forbidden
            118 => 413, // Payload Too Large
            119 => 402, // Payment Required
        ];
        return $statusCodesMap[$this->response['status'] ?? 0] ?? 500;
    }

    public function fetchErrorMessage(): string
    {
        return empty($this->error) ? $this->response['message'] : $this->error;
    }

    public function isRequestSuccessful(): bool
    {
        return $this->fetchStatusCode() === 200;
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

    public function fetchMessageId(): int
    {
        return $this->response['data']['messageId'] ?? 0;
    }

    public function fetchCost(): float
    {
        return $this->response['data']['cost'] ?? 0.0;
    }
}