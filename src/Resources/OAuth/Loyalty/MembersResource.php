<?php

namespace Piggy\Api\Resources\OAuth\Loyalty;

use Piggy\Api\Exceptions\RequestException;
use Piggy\Api\Mappers\Loyalty\MemberAndCreditBalanceResponseMapper;
use Piggy\Api\Mappers\Loyalty\MemberMapper;
use Piggy\Api\Models\Loyalty\Member;
use Piggy\Api\Models\Loyalty\MemberResponse;
use Piggy\Api\Resources\BaseResource;

/**
 * Class MembersResource
 * @package Piggy\Api\Resources\OAuth\Loyalty
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
