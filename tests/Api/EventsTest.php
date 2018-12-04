<?php

namespace Glorand\Drip\Tests\Api;

use Glorand\Drip\Drip;
use Glorand\Drip\Exceptions\DripException;
use Glorand\Drip\Models\Event;
use Glorand\Drip\Tests\TestCase;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;

class EventsTest extends TestCase
{
    /**
     * @test
     * @throws DripException
     */
    public function canListEvents()
    {
        $mock = new MockHandler([
            new Response(200, [], json_encode(['a' => 'b'])),
            new Response(401, ['Content-Length' => 0]),
        ]);
        $drip = new Drip($this->apiToken, $this->accountId, $this->userAgent);
        $drip->setHandler($mock);

        $events = $drip->events()->all();
        $this->assertTrue($events->isSuccess());
        $this->assertEquals(['a' => 'b'], $events->getContents());
        $this->assertEquals('OK', $events->getHttpMessage());

        $events = $drip->events()->all();
        $this->assertFalse($events->isSuccess());
        $this->assertEquals('Unauthorized', $events->getHttpMessage());

        $this->expectException(DripException::class);
        $events = $drip->events()->all(1, 1001);
    }

    /**
     * @test
     * @throws \Exception
     */
    public function canCreateEvent()
    {
        $mock = new MockHandler([
            new Response(403, []),
            new Response(200, []),
        ]);
        $drip = new Drip($this->apiToken, $this->accountId, $this->userAgent);
        $drip->setHandler($mock);

        $event = new Event();
        $event->setEmail('gombos.lorand@gmail.com');
        $event->setAction('Test Action Lorand');
        $event->addProperty('test', 'value');
        $event->setOccurredAt(new \DateTime());

        $response = $drip->events()->store($event);
        $this->assertFalse($response);

        $response = $drip->events()->store($event);
        $this->assertTrue($response);
    }
}
