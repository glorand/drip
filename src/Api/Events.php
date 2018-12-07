<?php

namespace Glorand\Drip\Api;

use Glorand\Drip\Api\Response\ApiResponse;
use Glorand\Drip\Exceptions\DripException;
use Glorand\Drip\Models\Event;

class Events extends Api
{
    /**
     * @param int $page
     * @param int $perPage
     *
     * @throws DripException
     *
     * @return Response\ApiResponse
     */
    public function list(int $page = 1, int $perPage = 100): ApiResponse
    {
        if (1 > $perPage || 1000 < $perPage) {
            throw new DripException('Invalid per page; maximum 1000');
        }

        return $this->sendGet(
            ':account_id:/event_actions',
            [
                'page'     => $page,
                'per_page' => $perPage,
            ]
        );
    }

    /**
     * Record an event
     * @see https://developer.drip.com/?shell#events
     *
     * @param Event $event
     *
     * @return bool
     */
    public function store(Event $event): bool
    {
        $response = $this->sendPost(
            ':account_id:/events',
            $event->toDrip()
        );

        return $response->isSuccess();
    }
}
