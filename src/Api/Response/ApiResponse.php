<?php

namespace Glorand\Drip\Api\Response;

use Error;
use Psr\Http\Message\ResponseInterface;

class ApiResponse
{
    /** @var string */
    protected $url;
    /** @var array */
    protected $options;
    /** @var ResponseInterface */
    protected $response;
    /** @var array */
    protected $body;

    public function __construct(string $url, array $options, ResponseInterface $response)
    {
        $this->url = $url;
        $this->options = $options;
        $this->response = $response;
        $this->body = json_decode((string) $response->getBody(), true);
    }

    public function getStatusCode(): int
    {
        return (int) $this->response->getStatusCode();
    }

    public function isSuccess(): bool
    {
        return $this->getStatusCode() >= 200 && $this->getStatusCode() <= 299;
    }

    public function getHttpMessage(): string
    {
        return $this->response->getReasonPhrase() ?? '';
    }

    public function getContents(): array
    {
        return $this->body;
    }

    public function getErrors()
    {
        if (!empty($this->body['errors'])) {
            return array_map(function ($rec) {
                return new Error($rec['message'], $rec['code']);
            }, $this->body['errors']);
        } else {
            return [];
        }
    }
}
