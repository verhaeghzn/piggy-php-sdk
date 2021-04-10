<?php

namespace Tests;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Psr7\Response;

/**
 * Class BaseTestCase
 * @package Tests
 */
class BaseTestCase extends TestCase
{
    /**
     * @var HttpClient
     */
    protected $httpClient;

    /**
     * @var MockHandler
     */
    protected $mockHandler;

    protected function setUp(): void
    {
        parent::setUp();

        $mock = new MockHandler();
        $handlerStack = HandlerStack::create($mock);
        $httpClient = new HttpClient(['handler' => $handlerStack]);

        $this->httpClient = $httpClient;
        $this->mockHandler = $mock;
    }

    protected function addExpectedResponse(array $data, array $meta = null, int $code = 200)
    {
        $response = new Response($code, [], json_encode([
            "data" => $data,
            "meta" => $meta
        ]));

        $this->mockHandler->append($response);
    }

    /**
     * @return HttpClient
     */
    public function getHttpClient(): HttpClient
    {
        return $this->httpClient;
    }

    /**
     * @return MockHandler
     */
    public function getMockHandler(): MockHandler
    {
        return $this->mockHandler;
    }
}