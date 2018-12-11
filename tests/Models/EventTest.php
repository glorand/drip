<?php

namespace Glorand\Drip\Tests\Models;

use Glorand\Drip\Models\Event;
use PHPUnit\Framework\TestCase;

class EventTest extends TestCase
{
    public function testModel()
    {
        $date = new \DateTime('2016-12-01');
        $data = [
            'events' => [
                [
                    'email'       => 'test@email.com',
                    'properties'  => [
                        'prop_0' => 'val_prop_0',
                        'prop_2' => 'val_prop_2',
                    ],
                    'action'      => 'test_action',
                    'occurred_at' => $date->format(DATE_ISO8601),
                ],
            ],
        ];

        $event = new Event();
        $event->setEmail('test@email.com')
            ->setAction('test_action')
            ->setOccurredAt($date)
            ->setProperties(['prop_0' => 'val_prop_0'])
            ->addProperty('prop_1', 'val_prop_1')
            ->addProperty('prop_2', 'val_prop_2')
            ->removeProperty('prop_1');
        $this->assertEquals($data, $event->toDrip());
    }
}
