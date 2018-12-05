<?php

namespace Glorand\Drip\Api;

use Glorand\Drip\Api\Response\ApiResponse;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response;

abstract class Api
{
    const GET = 'get';
    const POST = 'post';
    const PUT = 'put';
    const DELETE = 'delete';

    /**
     * @var Client
     */
    protected $client;
    /** @var string */
    protected $accountId;

    /**
     * Api constructor.
     *
     * @param Client $client
     * @param string $accountId
     */
    public function __construct(Client $client, string $accountId)
    {
        $this->client = $client;
        $this->accountId = $accountId;
    }

    protected function prepareUrl(string $url): string
    {
        if (false !== strpos($url, ':account_id:')) {
            $url = str_replace(':account_id:', $this->accountId, $url);
        }

        return trim($url, '/');
    }

    protected function sendGet($url, array $params = []): ApiResponse
    {
        $options['query'] = $params;

        return $this->makeRequest(self::GET, $this->prepareUrl($url), $options);
    }

    protected function sendPost($url, array $params = []): ApiResponse
    {
        $options['body'] = is_array($params) ? json_encode($params) : $params;

        return $this->makeRequest(self::POST, $this->prepareUrl($url), $options);
    }

    /**
     * @param       $method
     * @param       $url
     * @param array $options
     *
     * @return ApiResponse
     */
    private function makeRequest($method, $url, array $options = []): ApiResponse
    {
        try {
            $response = $this->client->request($method, $url, $options);
        } catch (GuzzleException $e) {
            $response = new Response($e->getCode(), [], $e->getMessage());
        }

        return new ApiResponse($url, $options, $response);
    }
}
