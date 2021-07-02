<?php

namespace Confluence\Tests;

use ArgumentCountError;
use Confluence\Base;
use Confluence\Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Confluence\Content;

class AuthTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testAuthBadUser()
    {
        $this->api = new Content($this->conf);
        $clientMock = $this->getMockBuilder(Client::class)->getMock();
        $clientMock->expects($this->once())
            ->method('request')
            ->with(
                'GET',
                'content'
            )
            ->willReturn(new Response(401, [
                'X-Seraph-LoginReason' => 'AUTHENTICATED_FAILED',
                'WWW-Authenticate' => 'OAuth realm="http%3A%2F%2Flocalhost%3A8090"',
                'Content-Type' => 'text/html;charset=utf-8',
            ]));
        $this->api->setClient($clientMock);
        try {
            $this->api->index();
        } catch (Exception $e) {
            $this->assertEquals(401, $e->getCode());
            $this->assertEquals('AUTHENTICATED_FAILED', $e->getMessage());
        }
    }

    public function testAuthNoConf()
    {
        $this->expectExceptionMessage('need: auth');
        $this->expectException(ArgumentCountError::class);
        $this->api = new Content([
            'base_uri' => $this->faker->url,
        ]);
    }
}
