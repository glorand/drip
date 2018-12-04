<?php

namespace Glorand\Drip;

use Glorand\Drip\Api\Events;
use Glorand\Drip\Api\Subscribers;
use Glorand\Drip\Traits\ClientManager;

class Drip
{
    use ClientManager;

    /**
     * Drip constructor.
     *
     * @param string $apiToken
     * @param string $accountId
     * @param string $userAgent
     */
    public function __construct(string $apiToken, string $accountId, string $userAgent)
    {
        $this->apiToken = $apiToken;
        $this->accountId = $accountId;
        $this->userAgent = $userAgent;
    }

    /**
     * @return Events
     */
    public function events(): Events
    {
        return new Events($this->getClient());
    }

    /**
     * @return Subscribers
     */
    public function subscribers(): Subscribers
    {
        return new Subscribers($this->getClient());
    }
}
