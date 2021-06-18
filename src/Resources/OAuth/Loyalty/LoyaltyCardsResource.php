<?php

namespace Piggy\Api\Resources\OAuth\Loyalty;

use Piggy\Api\Mappers\Loyalty\LoyaltyCardMapper;
use Piggy\Api\Models\Loyalty\LoyaltyCard;
use Piggy\Api\Models\Loyalty\Member;
use Piggy\Api\Resources\BaseResource;

/**
 * Class LoyaltyCardsResource
 * @package Piggy\Api\Resources\OAuth\Loyalty
 */
class LoyaltyCardsResource extends BaseResource
{
    /**
     * @var string
     */
    protected $resourceUri = "/api/v2/oauth/clients";

    /**
     * @param int $shopId
     * @param string $hash
     *
     * @return LoyaltyCard
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Piggy\Api\Exceptions\PiggyRequestException
     */
    public function findOneBy(int $shopId, string $hash): LoyaltyCard
    {
        $response = $this->client->get("{$this->resourceUri}/loyalty-cards/find-one-by", [
            "shop_id" => $shopId,
            "hash" => $hash,
        ]);

        $mapper = new LoyaltyCardMapper();

        return $mapper->map($response->getData());
    }

    /**
     * @param int $shopId
     * @param Member $memberId
     * @param LoyaltyCard $loyaltyCardId
     *
     * @return LoyaltyCard
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Piggy\Api\Exceptions\PiggyRequestException
     */
    public function link(int $shopId, Member $memberId, LoyaltyCard $loyaltyCardId): LoyaltyCard
    {
        $response = $this->client->post("{$this->resourceUri}/link-loyalty-card", [
            "shop_id" => $shopId,
            "member_id" => $memberId,
            "loyalty_card_id" => $loyaltyCardId,
        ]);

        $mapper = new LoyaltyCardMapper();

        return $mapper->map($response->getData());
    }
}
