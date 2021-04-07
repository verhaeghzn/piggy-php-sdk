<?php

namespace Piggy\Api;

use Piggy\Api\Http\BaseClient;
use Piggy\Api\Exceptions\RequestException;
use Piggy\Api\Mappers\OAuthTokenMapper;
use Piggy\Api\Model\OAuthToken;
use Piggy\Api\Traits\SetsCustomerResources as CustomerResources;

/**
 * Class CustomerClient
 * @package Piggy\Api
 */
class CustomerClient extends BaseClient
{
    use CustomerResources;

    /** @var string $clientId */
    public $clientId;

    /** @var string $clientSecret */
    public $clientSecret;

    /** @var string $redirecUri */
    public $redirectUri;

    /**
     * CustomerClient constructor.
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
     * @param string $code
     * @return OAuthToken
     * @throws RequestException
     */
    public function getOAuthToken(string $code): OAuthToken
    {
        $body = [
            "grant_type" => "authorization_code",
            "client_id" => $this->clientId,
            "client_secret" => $this->clientSecret,
            "code" => $code,
            "redirect_uri" => $this->redirectUri
        ];

        $response = $this->request("POST", "/oauth/token", $body);
        $data = json_decode($response->getBody()->getContents());

        $mapper = new OAuthTokenMapper();

        $OAuthToken = $mapper->mapFromResponse($data);

        return $OAuthToken;
    }

    /**
     * @param string $refreshToken
     * @return OAuthToken
     */
    public function refresh(string $refreshToken): OAuthToken
    {
        // Refresh token
        return new OAuthToken();
    }

    /**
     * @param string $redirectUri
     */
    public function setRedirectUri(string $redirectUri): void
    {
        $this->redirectUri = $redirectUri;
    }

    /**
     * @param string $accessToken
     * @return CustomerClient
     */
    public function setAccessToken(string $accessToken): self
    {
        $this->addHeader("Authorization", "Bearer {$accessToken}");
        return $this;
    }
}
