<?php

namespace Glorand\Drip\Tests\Api;

use Carbon\Carbon;
use Glorand\Drip\Api\Events;
use Glorand\Drip\Drip;
use Glorand\Drip\Exceptions\DripException;
use Glorand\Drip\Models\Event;
use Glorand\Drip\Models\Subscriber;
use Glorand\Drip\Tests\TestCase;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;

class SubscribersTest extends TestCase
{
    /**
     * @test
     */
    public function canListEvents()
    {
        $mock = new MockHandler([
            new Response(200, [], json_encode(['a' => 'b'])),
            new Response(401, ['Content-Length' => 0]),
        ]);
        $drip = new Drip($this->apiToken, $this->accountId, $this->userAgent);
        $drip->setHandler($mock);

        $events = $drip->subscribers()->list();
        $this->assertTrue($events->isSuccess());
        $this->assertEquals(['a' => 'b'], $events->getContents());
        $this->assertEquals('OK', $events->getHttpMessage());

        $events = $drip->subscribers()->list();
        $this->assertFalse($events->isSuccess());
        $this->assertEquals('Unauthorized', $events->getHttpMessage());

        $this->expectException(DripException::class);
        $events = $drip->events()->all(1, 1001);
    }

    /**
     * @test
     */
    public function canCreateEvent()
    {
        $mock = new MockHandler([
            new Response(403, []),
            new Response(200, []),
        ]);
        $drip = new Drip($this->apiToken, $this->accountId, $this->userAgent);
        $drip->setHandler($mock);
        $subscriber = new Subscriber();
        $subscriber->setEmail('gombos.lorand@gmail.com');
        $response = $drip->subscribers()->store($subscriber);
        $this->assertFalse($response);

        $response = $drip->subscribers()->store($subscriber);
        $this->assertTrue($response);
    }
}
