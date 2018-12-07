<?php

namespace Glorand\Drip;

use Glorand\Drip\Api\Accounts;
use Glorand\Drip\Api\Events;
use Glorand\Drip\Api\Subscribers;

class Drip extends ClientManager
{
    /** @var string */
    protected $accountId;

    /**
     * Drip constructor.
     *
     * @param string $accountId
     * @param string $apiToken
     * @param string $userAgent
     */
    public function __construct(string $accountId, string $apiToken, string $userAgent)
    {
        parent::__construct($apiToken, $userAgent);
        $this->accountId = $accountId;
    }

    /**
     * @return Events
     */
    public function events(): Events
    {
        return new Events($this->getClient(), $this->accountId);
    }

    /**
     * @return Subscribers
     */
    public function subscribers(): Subscribers
    {
        return new Subscribers($this->getClient(), $this->accountId);
    }

    /**
     * @return Accounts
     */
    public function accounts(): Accounts
    {
        return new Accounts($this->getClient(), $this->accountId);
    }
}
