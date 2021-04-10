<?php

namespace Piggy\Api;

use GuzzleHttp\ClientInterface;
use Piggy\Api\Exceptions\RequestException;
use Piggy\Api\Http\BaseClient;
use Piggy\Api\Http\Traits\SetsOAuthResources as OAuthResources;

/**
 * Class OAuthClient
 * @package Piggy\Api
 */
class OAuthClient extends BaseClient
{
    use OAuthResources;

    /** @var string $clientId */
    public $clientId;

    /** @var string $clientSecret */
    public $clientSecret;

    /**
     * OAuthClient constructor.
     * @param $clientId
     * @param string $clientSecret
     * @param ClientInterface|null $client
     */
    public function __construct($clientId, string $clientSecret, ?ClientInterface $client = null)
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;

        parent::__construct($client);

        $this->setResources($this);
    }

    /**
     * @return Http\Responses\Response
     * @throws Exceptions\BadResponseException
     * @throws RequestException
     */
    public function ping()
    {
        $response = $this->get("/api/v2/oauth/clients", []);

        return $response;
    }

    /**
     * @return string
     * @throws Exceptions\BadResponseException
     * @throws RequestException
     */
    public function getAccessToken(): string
    {
        $body = [
            "grant_type" => "client_credentials",
            "client_id" => $this->clientId,
            "client_secret" => $this->clientSecret
        ];

        $response = $this->authenticationRequest("/oauth/token", $body);

        return $response->getAccessToken();
    }

    /**
     * @param $accessToken
     * @return OAuthClient
     */
    public function setAccessToken($accessToken): self
    {
        $this->addHeader("Authorization", "Bearer {$accessToken}");
        return $this;
    }
}