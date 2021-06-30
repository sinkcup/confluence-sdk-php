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

    public function testIndexFailed()
    {
        try {
            $this->api->index();
        } catch (Exception $e) {
            $this->assertEquals(Exception::$codeStr2Num['MethodNotAllowed'], $e->getCode());
        }
    }

    public function testShow()
    {
        $data = [ 'foo' => 'bar' ];
        $id = $this->faker->randomNumber();
        $clientMock = $this->getMockBuilder(Client::class)->getMock();
        $clientMock->expects($this->once())
            ->method('request')
            ->with(
                'GET',
                $id
            )
            ->willReturn(new Response(200, [], json_encode($data)));
        $this->api->setClient($clientMock);

        $r = $this->api->show($id);
        $this->assertEquals($data, $r);
    }
}
