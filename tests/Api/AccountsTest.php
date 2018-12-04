<?php

namespace Glorand\Drip\Tests\Api;

use Glorand\Drip\Drip;
use Glorand\Drip\Tests\TestCase;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;

class AccountsTest extends TestCase
{

    public function testList()
    {
        $mock = new MockHandler([
            new Response(200, [], json_encode(['a' => 'b'])),
        ]);
        $drip = new Drip($this->apiToken, $this->accountId, $this->userAgent);
        $drip->setHandler($mock);
        $accounts = $drip->accounts()->list();
        $this->assertTrue($accounts->isSuccess());
        $this->assertEquals(['a' => 'b'], $accounts->getContents());
        $this->assertEquals('OK', $accounts->getHttpMessage());
    }

    public function testShow()
    {
        $mock = new MockHandler([
            new Response(200, [], json_encode(['a' => 'b'])),
        ]);
        $drip = new Drip($this->apiToken, $this->accountId, $this->userAgent);
        $drip->setHandler($mock);
        $accounts = $drip->accounts()->show(1);
        $this->assertTrue($accounts->isSuccess());
        $this->assertEquals(['a' => 'b'], $accounts->getContents());
        $this->assertEquals('OK', $accounts->getHttpMessage());
    }
}
