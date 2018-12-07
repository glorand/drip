<?php

namespace Glorand\Drip\Models;

use DateTime;
use Glorand\Drip\Models\Traits\Jsonable;
use JsonSerializable;

class Event implements JsonSerializable
{
    use Jsonable;

    /**
     * @var array
     */
    protected $properties;
    /**
     * @var string
     */
    protected $email;
    /**
     * @var string
     */
    protected $action;
    /**
     * @var DateTime
     */
    protected $occurred_at;

    /**
     * @param $key
     * @param $value
     *
     * @return Event
     */
    public function addProperty($key, $value): self
    {
        $this->properties[$key] = $value;

        return $this;
    }

    /**
     * @param $key
     *
     * @return Event
     */
    public function removeProperty($key): self
    {
        if (!empty($this->properties[$key])) {
            unset($this->properties[$key]);
        }

        return $this;
    }

    /**
     * @param array $properties
     *
     * @return Event
     */
    public function setProperties(array $properties): self
    {
        $this->properties = $properties;

        return $this;
    }

    /**
     * @param string $email
     *
     * @return Event
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @param string $action
     *
     * @return Event
     */
    public function setAction(string $action): self
    {
        $this->action = $action;

        return $this;
    }

    /**
     * @param DateTime $occurredAt
     *
     * @return Event
     */
    public function setOccurredAt(DateTime $occurredAt): self
    {
        $this->occurred_at = $occurredAt;

        return $this;
    }

    public function toDrip(): array
    {
        return [
            "events" => [
                $this->jsonSerialize(),
            ],
        ];
    }
}
