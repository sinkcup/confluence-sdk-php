<?php

namespace Confluence\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Faker;

class TestCase extends \PHPUnit\Framework\TestCase
{
    protected $api;
    protected $faker;

    protected function setUp(): void
    {
        $this->faker = Faker\Factory::create();
    }

    protected function mockResponse($data, $options = [])
    {
        $mock = new MockHandler([
            new Response($options['status'] ?? 200, $options['headers'] ?? [], json_encode($data)),
        ]);
        $handlerStack = HandlerStack::create($mock);
        $this->api->setClient(new Client(['handler' => $handlerStack]));
    }
}
