<?php

namespace Glorand\Drip\Api;

use Glorand\Drip\Api\Response\ApiResponse;

class Accounts extends Api
{
    /**
     * List all accounts.
     * @return Response\ApiResponse
     */
    public function list(): ApiResponse
    {
        return $this->makeRequest(self::GET, $this->prepareUrl('accounts'));
    }

    /**
     * Fetch an account.
     *
     * @param string $accountId
     *
     * @return ApiResponse
     */
    public function show(string $accountId): ApiResponse
    {
        return $this->makeRequest(self::GET, $this->prepareUrl("accounts/$accountId"));
    }
}
