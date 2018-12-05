<?php

namespace Glorand\Drip\Tests\Api;

use Glorand\Drip\Drip;
use Glorand\Drip\Exceptions\DripException;
use Glorand\Drip\Models\Subscriber;
use Glorand\Drip\Tests\TestCase;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;

class SubscribersTest extends TestCase
{
    /**
     * @test
     */
    public function testList()
    {
        $mock = new MockHandler([
            new Response(200, [], json_encode(['a' => 'b'])),
            new Response(401, ['Content-Length' => 0]),
        ]);
        $drip = new Drip($this->accountId, $this->apiToken, $this->userAgent);
        $drip->setHandler($mock);

        $events = $drip->subscribers()->list();
        $this->assertTrue($events->isSuccess());
        $this->assertIsArray($events->getContents());
        $this->assertEquals('OK', $events->getHttpMessage());

        $events = $drip->subscribers()->list();
        $this->assertFalse($events->isSuccess());
        $this->assertEquals('Unauthorized', $events->getHttpMessage());

        $this->expectException(DripException::class);
        $events = $drip->events()->list(1, 1001);
    }

    /**
     * @test
     */
    public function testStore()
    {
        $mock = new MockHandler([
            new Response(403, []),
            new Response(200, []),
        ]);
        $drip = new Drip($this->accountId, $this->apiToken, $this->userAgent);
        $drip->setHandler($mock);
        $subscriber = new Subscriber();
        $subscriber->setEmail('test@email.com');
        $response = $drip->subscribers()->store($subscriber);
        $this->assertFalse($response);

        $response = $drip->subscribers()->store($subscriber);
        $this->assertTrue($response);
    }
}
