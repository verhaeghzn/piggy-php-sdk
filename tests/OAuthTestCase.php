<?php

namespace Piggy\Api\Tests;

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
}