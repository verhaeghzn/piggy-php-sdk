<?php

namespace Piggy\Api\Http\Responses;

/**
 * Class AuthenticationResponse
 * @package Piggy\Api\Http\Responses
 */
class AuthenticationResponse
{
    /**
     * @var string
     */
    private $tokenType;

    /**
     * @var string
     */
    private $expiresIn;

    /**
     * @var string
     */
    private $accessToken;

    /**
     * @var string
     */
    private $refreshToken;

    /**
     * AuthenticationResponse constructor.
     * @param object $data
     */
    public function __construct(object $data)
    {
        $this->tokenType = $data->token_type;
        $this->expiresIn = $data->expires_in;
        $this->accessToken = $data->access_token;
        $this->refreshToken = $data->refresh_token;
    }

    /**
     * @return string
     */
    public function getRefreshToken(): string
    {
        return $this->refreshToken;
    }

    /**
     * @return string
     */
    public function getTokenType(): string
    {
        return $this->tokenType;
    }

    /**
     * @return string
     */
    public function getExpiresIn(): string
    {
        return $this->expiresIn;
    }

    /**
     * @return string
     */
    public function getAccessToken(): string
    {
        return $this->accessToken;
    }
}
