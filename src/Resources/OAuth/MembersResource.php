<?php

namespace Piggy\Api\Resources\OAuth;

use Piggy\Api\Exceptions\BadResponseException;
use Piggy\Api\Exceptions\RequestException;
use Piggy\Api\Mappers\MemberMapper;
use Piggy\Api\Mappers\Loyalty\MemberAndCreditBalanceResponseMapper;
use Piggy\Api\Models\Member;
use Piggy\Api\Models\MemberResponse;
use Piggy\Api\Resources\BaseResource;

/**
 * Class MembersResource
 * @package Piggy\Api\Resources\OAuth
 */
class MembersResource extends BaseResource
{
    /**
     * @var string
     */
    protected $resourceUri = "/api/v2/oauth/clients/members";

    /**
     * @param int $shopId
     * @param string $email
     * @return Member
     * @throws BadResponseException
     * @throws RequestException
     */
    public function create(int $shopId, string $email): Member
    {
        $body = [
            "shop_id" => $shopId,
            "email" => $email,
        ];

        $response = $this->client->post($this->resourceUri, $body);

        $mapper = new MemberMapper();

        return $mapper->map($response->getData());
    }

    /**
     * @param int $shopId
     * @param string $email
     * @return MemberResponse
     * @throws BadResponseException
     * @throws RequestException
     */
    public function findOneBy(int $shopId, string $email): MemberResponse
    {
        $body = [
            "shop_id" => $shopId,
            "email" => $email,
        ];

        $response = $this->client->get( "{$this->resourceUri}/find-one-by", $body);

        $mapper = new MemberAndCreditBalanceResponseMapper();

        return $mapper->map($response->getData());
    }

    /**
     * @param int $shopId
     * @param int $id
     * @return MemberResponse
     * @throws BadResponseException
     * @throws RequestException
     */
    public function get(int $shopId, int $id): MemberResponse
    {
        $body = [
            "shop_id" => $shopId,
        ];

        $response = $this->client->get("{$this->resourceUri}/$id", $body);

        $mapper = new MemberAndCreditBalanceResponseMapper();

        return $mapper->map($response->getData());
    }
}
