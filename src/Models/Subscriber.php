<?php

namespace Glorand\Drip\Models;

use Glorand\Drip\Models\Traits\Jsonable;

class Subscriber
{
    use Jsonable;

    /** @var string */
    protected $email;
    /** @var string */
    protected $new_email;
    /** @var string */
    protected $user_id;
    /** @var string */
    protected $time_zone;
    /** @var string */
    protected $ip_address;
    /** @var array */
    protected $custom_fields;
    /** @var array */
    protected $tags;
    /** @var array */
    protected $remove_tags;

    /**
     * @param $key
     * @param $value
     * @return Subscriber
     */
    public function addCustomField($key, $value): self
    {
        $this->custom_fields[$key] = $value;

        return $this;
    }

    /**
     * @param $key
     * @return Subscriber
     */
    public function removeCustomField($key): self
    {
        if (!empty($this->custom_fields[$key])) {
            unset($this->custom_fields[$key]);
        }

        return $this;
    }

    /**
     * @param $key
     * @param $value
     * @return Subscriber
     */
    public function addTag($key, $value): self
    {
        $this->tags[$key] = $value;

        return $this;
    }

    /**
     * @param $key
     * @return Subscriber
     */
    public function removeTag($key): self
    {
        if (!empty($this->tags[$key])) {
            unset($this->tags[$key]);
        }

        return $this;
    }

    /**
     * @param string $email
     * @return Subscriber
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @param string $new_email
     * @return Subscriber
     */
    public function setNewEmail(string $new_email): self
    {
        $this->new_email = $new_email;

        return $this;
    }

    /**
     * @param string $user_id
     * @return Subscriber
     */
    public function setUserId(string $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * @param string $time_zone
     * @return Subscriber
     */
    public function setTimeZone(string $time_zone): self
    {
        $this->time_zone = $time_zone;

        return $this;
    }

    /**
     * @param string $ip_address
     * @return Subscriber
     */
    public function setIpAddress(string $ip_address): self
    {
        $this->ip_address = $ip_address;

        return $this;
    }

    /**
     * @param array $custom_fields
     * @return Subscriber
     */
    public function setCustomFields(array $custom_fields): self
    {
        $this->custom_fields = $custom_fields;

        return $this;
    }

    /**
     * @param array $tags
     * @return Subscriber
     */
    public function setTags(array $tags): self
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * @param array $remove_tags
     * @return Subscriber
     */
    public function setRemoveTags(array $remove_tags): self
    {
        $this->remove_tags = $remove_tags;

        return $this;
    }
}
