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
     * @param object $data
     * @return OAuthToken
     */
    public function map(object $data): OAuthToken
    {
        $token = new OAuthToken();

        $token->setAccessToken($data->getAccessToken());
        $token->setRefreshToken($data->getRefreshToken());
        $token->setExpiresIn($data->getExpiresIn());

        return $token;
    }
}