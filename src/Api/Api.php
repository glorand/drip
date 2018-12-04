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

    /**
     * Api constructor.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    protected function prepareUrl(string $url): string
    {
        return 'v2/'.$url;
    }

    /**
     * Determines whether the response is a success.
     *
     * @param int $code
     *
     * @return bool
     */
    protected function isSuccessResponse($code): bool
    {
        return $code >= 200 && $code <= 299;
    }

    /**
     * @param $method
     * @param $url
     * @param array $params
     *
     * @return ApiResponse
     */
    public function makeRequest($method, $url, $params = [])
    {
        $options = [];
        switch ($method) {
            case self::GET:
                $options['query'] = $params;
                break;
            case self::POST:
            case self::DELETE:
                // @codeCoverageIgnoreStart
            case self::PUT:
                // @codeCoverageIgnoreEnd
                $options['body'] = is_array($params) ? json_encode($params) : $params;
                break;
            default:
                // @codeCoverageIgnoreStart
                $method = 'GET';
                break;
            // @codeCoverageIgnoreEnd
        }

        try {
            $response = $this->client->request($method, $url, $options);
        } catch (GuzzleException $e) {
            $response = new Response($e->getCode(), [], $e->getMessage());
        }

        return new ApiResponse($url, $options, $response);
    }
}
