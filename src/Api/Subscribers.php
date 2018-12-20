<?php

namespace Glorand\Drip\Api;

use Glorand\Drip\Api\Response\ApiResponse;
use Glorand\Drip\Models\Subscriber;

class Subscribers extends Api
{
    /**
     * @param int   $page
     * @param int   $perPage
     * @param array $params
     *                       status - Default - active
     *                       tags  - Optional
     *                       subscribed_before - Optional. A ISO-8601 datetime. Eg. "2017-01-01T00:00:00Z"
     *                       subscribed_after - Optional. A ISO-8601 datetime. Eg. "2016-01-01T00:00:00Z"
     *
     * @return \Glorand\Drip\Api\Response\ApiResponse;
     */
    public function list(int $page = 1, int $perPage = 100, array $params = []): ApiResponse
    {
        return $this->sendGet(
            ':account_id:/subscribers',
            array_merge(
                [
                    'page'     => $page,
                    'per_page' => $perPage,
                ],
                $params
            )
        );
    }

    /**
     * @param \Glorand\Drip\Models\Subscriber $subscriber
     *
     * @return bool
     */
    public function store(Subscriber $subscriber): bool
    {
        $response = $this->sendPost(
            ':account_id:/subscribers',
            $subscriber->toDrip()
        );

        return $response->isSuccess();
    }

    /**
     * @param array $subscribers
     *
     * @return bool
     */
    public function batchStore(array $subscribers)
    {
        $data = [];
        foreach ($subscribers as $subscriber) {
            if (is_array($subscriber)) {
                $data[] = $subscriber;
            } elseif ($subscriber instanceof Subscriber) {
                $data[] = $subscriber->jsonSerialize();
            }
        }

        $postData = [
            'batches' => [
                [
                    'subscribers' => $data,
                ],
            ],
        ];

        $response = $this->sendPost(
            ':account_id:/subscribers/batches',
            $postData
        );

        return $response->isSuccess();
    }

    public function batchUnsubscribe(array $subscribers)
    {
        $data = [];
        foreach ($subscribers as $subscriber) {
            if (is_array($subscriber)) {
                $data[] = $subscriber;
            } elseif ($subscriber instanceof Subscriber) {
                $data[] = $subscriber->getEmail();
            }
        }

        $postData = [
            'batches' => [
                [
                    'subscribers' => $data,
                ],
            ],
        ];

        $response = $this->sendPost(
            ':account_id:/unsubscribes/batches',
            $postData
        );

        return $response->isSuccess();
    }
}
