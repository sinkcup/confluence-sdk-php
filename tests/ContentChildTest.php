<?php

namespace Confluence\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Confluence\ContentChild;

class ContentChildTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->api = new ContentChild();
    }

    public function testIndex()
    {
        $data = [ 'foo' => 'bar' ];
        $params = [
            'expand' => 'page',
            'start' => 20,
            'limit' => 10,
        ];
        $clientMock = $this->getMockBuilder(Client::class)->getMock();
        $clientMock->expects($this->once())
            ->method('request')
            ->with(
                'GET',
                '',
                ['query' => $params]
            )
            ->willReturn(new Response(200, [], json_encode($data)));
        $this->api->setClient($clientMock);

        $r = $this->api->index($params);
        $this->assertEquals($data, $r);

        $data = ['foo' => 'bar'];
        $this->mockResponse($data);

        $r = $this->api->index();
        $this->assertEquals($data, $r);
    }

    public function testIndexByType()
    {
        $data = [ 'foo' => 'bar' ];
        $type = 'comment';
        $params = [
            'start' => 20,
            'limit' => 10,
        ];
        $clientMock = $this->getMockBuilder(Client::class)->getMock();
        $clientMock->expects($this->once())
            ->method('request')
            ->with(
                'GET',
                $type,
                ['query' => $params]
            )
            ->willReturn(new Response(200, [], json_encode($data)));
        $this->api->setClient($clientMock);

        $params['type'] = $type;
        $r = $this->api->index($params);
        $this->assertEquals($data, $r);
    }
}
