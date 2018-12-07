<?php

namespace Glorand\Drip;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;

abstract class ClientManager
{
    /** @var string */
    private $apiToken;
    /** @var string */
    private $userAgent;
    /** @var string */
    private $apiEndPoint = 'https://api.getdrip.com/v2/';
    /** @var Client */
    private $client = null;
    /** @var HandlerStack */
    private $handler;

    public function __construct(string $apiToken, string $userAgent)
    {
        $this->apiToken = $apiToken;
        $this->userAgent = $userAgent;
    }

    /**
     * @param array $options
     *
     * @return Client
     */
    public function getClient(array $options = [])
    {
        if (!is_null($this->client)) {
            return $this->client;
        }

        $options = array_merge(
            ['handler' => $this->createClientHandler()],
            $options,
            [
                'base_uri' => $this->apiEndPoint,
                'auth'     => [
                    $this->apiToken,
                    '',
                ],
                'headers'  => [
                    'Accept'       => 'application/vnd.api+json',
                    'Content-Type' => 'application/vnd.api+json',
                    'User-Agent'   => $this->userAgent,
                ],
            ]
        );
        $this->client = new Client($options);

        return $this->client;
    }

    public function setClient(Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @param callable|null $handler
     */
    public function setHandler(callable $handler = null)
    {
        $this->handler = $handler;
    }

    /**
     * @return HandlerStack
     */
    private function createClientHandler(): HandlerStack
    {
        $stack = HandlerStack::create();
        if ($this->handler) {
            $stack->setHandler($this->handler);
        }

        return $stack;
    }
}
