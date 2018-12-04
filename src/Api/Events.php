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
     * @return Response\ApiResponse
     * @throws DripException
     */
    public function all(int $page = 1, int $perPage = 100): ApiResponse
    {
        if (1 > $perPage || 1000 < $perPage) {
            throw new DripException('Invalid per page; maximum 1000');
        }

        return $this->makeRequest(
            self::GET,
            $this->prepareUrl('/:account_id:/event_actions'),
            [
                'page'     => $page,
                'per_page' => $perPage,
            ]
        );
    }

    public function store(Event $event): bool
    {
        $response = $this->makeRequest(
            self::POST,
            $this->prepareUrl('/:account_id:/event_actions'),
            $event->jsonSerialize()
        );

        return $response->isSuccess();
    }
}
