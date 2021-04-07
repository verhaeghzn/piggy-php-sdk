<?php

namespace Piggy\Api;

use Piggy\Api\Exceptions\RequestException;
use Piggy\Api\Http\BaseClient;
use Piggy\Api\Traits\SetsOAuthResources as OAuthResources;

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
     * @param string $clientId
     * @param string $clientSecret
     */
    public function __construct(string $clientId, string $clientSecret)
    {
        parent::__construct();

        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;

        $this->setResources($this);
    }

    /**
     * @return string
     * @throws RequestException
     */
    public function getAccessToken(): string
    {
        $body = [
            "grant_type" => "client_credentials",
            "client_id" => $this->clientId,
            "client_secret" => $this->clientSecret
        ];

        $response = $this->request("POST", "/oauth/token", $body);

        $clientToken = json_decode($response->getBody()->getContents(), true);

        return $clientToken['access_token'];
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