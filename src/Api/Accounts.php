<?php

namespace Glorand\Drip\Api;

use Glorand\Drip\Api\Response\ApiResponse;

class Accounts extends Api
{
    /**
     * List all accounts.
     *
     * @return \Glorand\Drip\Api\Response\ApiResponse
     */
    public function list(): ApiResponse
    {
        return $this->sendGet('accounts');
    }

    /**
     * Fetch an account.
     *
     * @param string $accountId
     *
     * @return \Glorand\Drip\Api\Response\ApiResponse
     */
    public function show(string $accountId): ApiResponse
    {
        return $this->sendGet("accounts/$accountId");
    }
}
