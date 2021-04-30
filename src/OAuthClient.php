<?php

namespace Piggy\Api;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use Piggy\Api\Http\BaseClient;
use Piggy\Api\Http\Traits\SetsOAuthResources as OAuthResources;

/**
 * Class OAuthClient
 * @package Piggy\Api
 */
class OAuthClient extends BaseClient
{
    use OAuthResources;

    /**
     * @var int
     */
    public $clientId;

    /**
     * @var string
     */
    public $clientSecret;

    /**
     * OAuthClient constructor.
     * @param int $clientId
     * @param string $clientSecret
     * @param ClientInterface|null $client
     */
    public function __construct(int $clientId, string $clientSecret, ?ClientInterface $client = null)
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;

        parent::__construct($client);

        $this->setResources($this);
    }

    /**
     * @return Http\Responses\Response
     * @throws Exceptions\PiggyRequestException
     * @throws GuzzleException
     */
    public function ping()
    {
        $response = $this->get("/api/v2/oauth/clients");

        return $response;
    }

    /**
     * @return string
     * @throws Exceptions\PiggyRequestException
     * @throws GuzzleException
     */
    public function getAccessToken(): string
    {
        $response = $this->authenticationRequest("/oauth/token", [
            "grant_type" => "client_credentials",
            "client_id" => $this->clientId,
            "client_secret" => $this->clientSecret
        ]);

        return $response->getAccessToken();
    }

    /**
     * @param string $accessToken
     * @return $this
     */
    public function setAccessToken(string $accessToken): self
    {
        $this->addHeader("Authorization", "Bearer {$accessToken}");
        return $this;
    }
}
