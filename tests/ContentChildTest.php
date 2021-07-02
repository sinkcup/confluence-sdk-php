<?php

namespace Confluence\Tests;

use Confluence\Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Confluence\ContentChild;

class ContentChildTest extends TestCase
{
    private int $contentId;

    protected function setUp(): void
    {
        parent::setUp();
        $this->api = new ContentChild($this->conf);
        $this->contentId = $this->faker->randomNumber();
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
                "content/{$this->contentId}/child",
                ['query' => $params]
            )
            ->willReturn(new Response(200, [], json_encode($data)));
        $this->api->setClient($clientMock);

        $r = $this->api->prepare(['content_id' => $this->contentId])->index($params);
        $this->assertEquals($data, $r);
    }

    public function testIndexWithoutPrepare()
    {
        try {
            $this->api->index();
        } catch (Exception $e) {
            $this->assertEquals(Exception::$codeStr2Num['BadUri'], $e->getCode());
        }
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
        $r = $this->api->prepare(['content_id' => $this->contentId])->index($params);
        $this->assertEquals($data, $r);
    }
}
