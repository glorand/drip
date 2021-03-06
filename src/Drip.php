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
    public function __construct(string $accountId, string $apiToken, string $userAgent = 'DripPHP Agent')
    {
        parent::__construct($apiToken, $userAgent);
        $this->accountId = $accountId;
    }

    /**
     * @return \Glorand\Drip\Api\Events
     */
    public function events(): Events
    {
        return new Events($this->getClient(), $this->accountId);
    }

    /**
     * @return \Glorand\Drip\Api\Subscribers
     */
    public function subscribers(): Subscribers
    {
        return new Subscribers($this->getClient(), $this->accountId);
    }

    /**
     * @return \Glorand\Drip\Api\Accounts
     */
    public function accounts(): Accounts
    {
        return new Accounts($this->getClient(), $this->accountId);
    }
}
