<?php

namespace Piggy\Api\Tests;

use Piggy\Api\Exceptions\MaintenanceModeException;
use Piggy\Api\OAuthClient;

/**
 * Class OAuthTestCase
 * @package Piggy\Api\Tests
 */
class OAuthTestCase extends BaseTestCase
{
    /**
     * @var OAuthClient
     */
    protected $mockedClient;

    protected function setUp(): void
    {
        parent::setUp();

        $oauthClient = new OAuthClient(1, "secret", $this->httpClient);
        $oauthClient->addHeader("Authorization", 'Bearer token');

        $this->mockedClient = $oauthClient;
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        $this->mockHandler->reset();
    }

    /** @test */
    public function throws_maintenance_mode_exception()
    {
        $this->addExpectedResponse([], null, 503);
        $this->expectException(MaintenanceModeException::class);
        $this->mockedClient->webshops->get(1);
    }
}