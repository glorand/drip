<?php

namespace Glorand\Drip\Traits;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use Psr\Http\Message\RequestInterface;

trait ClientManager
{
    /** @var string */
    private $apiToken;
    /** @var string */
    private $accountId;
    /** @var string */
    private $userAgent;
    /** @var string */
    private $apiEndPoint = 'https://api.getdrip.com';
    /** @var Client */
    private $client = null;
    /** @var HandlerStack */
    private $handler;

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

    public function setHandler(callable $handler = null)
    {
        $this->handler = $handler;
    }

    private function createClientHandler(): HandlerStack
    {
        $stack = HandlerStack::create();
        if ($this->handler) {
            $stack->setHandler($this->handler);
        }

        $stack->unshift(Middleware::mapRequest(function (RequestInterface $r) {
            $path = $r->getUri()->getPath();
            if (false !== strpos($path, ':account_id:')) {
                $path = str_replace(':account_id:', $this->accountId, $path);
            }

            return $r->withUri($r->getUri()->withPath($path));
        }));

        return $stack;
    }
}
