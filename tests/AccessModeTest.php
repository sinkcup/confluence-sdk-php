<?php

namespace Confluence\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Confluence\AccessMode;
use Confluence\Exception;

class AccessModeTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->api = new AccessMode($this->conf);
    }

    public function testShowFailed()
    {
        try {
            $this->api->show(1);
        } catch (Exception $e) {
            $this->assertEquals(Exception::$codeStr2Num['MethodNotAllowed'], $e->getCode());
        }
    }

    public function testIndex()
    {
        $data = [ 'foo' => 'bar' ];
        $clientMock = $this->getMockBuilder(Client::class)->getMock();
        $clientMock->expects($this->once())
            ->method('request')
            ->with(
                'GET',
                "accessmode"
            )
            ->willReturn(new Response(200, [], json_encode($data)));
        $this->api->setClient($clientMock);

        $r = $this->api->index();
        $this->assertEquals($data, $r);
    }
}
