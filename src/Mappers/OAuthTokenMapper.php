<?php

namespace Piggy\Api\Mappers;

use Piggy\Api\Models\OAuthToken;
use stdClass;

/**
 * Class OAuthTokenMapper
 * @package Piggy\Api\Mappers
 */
class OAuthTokenMapper
{
    /**
     * @param stdClass $data
     * @return OAuthToken
     */
    public function map(stdClass $data): OAuthToken
    {
        $token = new OAuthToken();

        $token->setAccessToken($data->access_token);
        $token->setRefreshToken($data->refresh_token);
        $token->setExpiresIn($data->expires_in);

        return $token;
    }
}