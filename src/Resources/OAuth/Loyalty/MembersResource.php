<?php

namespace Piggy\Api\Resources\OAuth\Loyalty;

use Piggy\Api\Exceptions\RequestException;
use Piggy\Api\Mappers\Loyalty\MemberAndCreditBalanceResponseMapper;
use Piggy\Api\Mappers\Loyalty\MemberMapper;
use Piggy\Api\Models\Loyalty\Member;
use Piggy\Api\Models\Loyalty\MemberResponse;
use Piggy\Api\Models\Shops\Shop;
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
     * @param Shop $shop
     * @param string $email
     * @return Member
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Piggy\Api\Exceptions\PiggyRequestException
     */
    public function create(Shop $shop, string $email): Member
    {
        $response = $this->client->post($this->resourceUri, [
            "shop_id" => $shop->getId(),
            "email" => $email,
        ]);

        $mapper = new MemberMapper();

        return $mapper->map($response->getData());
    }

    /**
     * @param Shop $shop
     * @param string $email
     * @return MemberResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Piggy\Api\Exceptions\PiggyRequestException
     */
    public function findOneBy(Shop $shop, string $email): MemberResponse
    {
        $response = $this->client->get("{$this->resourceUri}/find-one-by", [
            "shop_id" => $shop->getId(),
            "email" => $email,
        ]);

        $mapper = new MemberAndCreditBalanceResponseMapper();

        return $mapper->map($response->getData());
    }

    /**
     * @param Shop $shop
     * @param int $id
     * @return MemberResponse
     * @throws RequestException
     */
    public function get(Shop $shop, int $id): MemberResponse
    {
        $response = $this->client->get("{$this->resourceUri}/$id", [
            "shop_id" => $shop->getId(),
        ]);

        $mapper = new MemberAndCreditBalanceResponseMapper();

        return $mapper->map($response->getData());
    }
}
