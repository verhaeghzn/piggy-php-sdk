<?php

namespace Piggy\Api\Resources\OAuth\Loyalty;

use Piggy\Api\Exceptions\RequestException;
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
    protected $resourceUri = "/api/v2/oauth/clients/";

    /**
     * @param int $shopId
     * @param string $hash
     * @return LoyaltyCard
     * @throws RequestException
     */
    public function findOneBy(int $shopId, string $hash): LoyaltyCard
    {
        $body = [
            "shop_id" => $shopId,
            "hash" => $hash,
        ];

        $response = $this->client->get( "{$this->resourceUri}/loyalty-cards/find-one-by", $body);

        $mapper = new LoyaltyCardMapper();

        return $mapper->map($response->getData());
    }

    /**
     * @param int $shopId
     * @param Member $member
     * @param LoyaltyCard $loyaltyCard
     * @return LoyaltyCard
     * @throws RequestException
     */
    public function link(int $shopId, Member $member, LoyaltyCard $loyaltyCard): LoyaltyCard
    {
        $body = [
            "shop_id" => $shopId,
            "member_id" => $member->getId(),
            "loyalty_card_id" => $loyaltyCard->getId(),
        ];

        $response = $this->client->post( "{$this->resourceUri}/link-loyalty-card", $body);

        $mapper = new LoyaltyCardMapper();

        return $mapper->map($response->getData());
    }
}