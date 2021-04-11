<?php

namespace Piggy\Api\Tests;

use Piggy\Api\OAuthClient;

class OAuthTestCase extends BaseTestCase
{
    protected $mockedClient;

    protected function setUp(): void
    {
        parent::setUp();

        $oauthClient = new OAuthClient("1", "1", $this->httpClient);
        $oauthClient->addHeader("Authorization", 'Bearer token');

        $this->mockedClient = $oauthClient;
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        $this->mockHandler->reset();
    }
}
