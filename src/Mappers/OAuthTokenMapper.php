<?php

namespace Piggy\Api\Mappers;

use Piggy\Api\Model\OAuthToken;

/**
 * Class OAuthTokenMapper
 * @package Piggy\Api\Mappers
 */
class OAuthTokenMapper
{
    /**
     * @param $response
     * @return OAuthToken
     */
    public function mapFromResponse($response): OAuthToken
    {
        $token = new OAuthToken();

        $token->setAccessToken($response->access_token);
        $token->setRefreshToken($response->refresh_token);
        $token->setExpiresIn($response->expires_in);

        return $token;
    }
}