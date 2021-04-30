<?php

namespace Piggy\Api\Resources\OAuth\Loyalty;

use Piggy\Api\Exceptions\RequestException;
use Piggy\Api\Mappers\Loyalty\LoyaltyCardMapper;
use Piggy\Api\Models\Loyalty\LoyaltyCard;
use Piggy\Api\Models\Loyalty\Member;
use Piggy\Api\Models\Shops\Shop;
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
     * @param Shop $shop
     * @param string $hash
     * @return LoyaltyCard
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Piggy\Api\Exceptions\PiggyRequestException
     */
    public function findOneBy(Shop $shop, string $hash): LoyaltyCard
    {
        $response = $this->client->get("{$this->resourceUri}/loyalty-cards/find-one-by", [
            "shop_id" => $shop->getId(),
            "hash" => $hash,
        ]);

        $mapper = new LoyaltyCardMapper();

        return $mapper->map($response->getData());
    }

    /**
     * @param Shop $shop
     * @param Member $member
     * @param LoyaltyCard $loyaltyCard
     * @return LoyaltyCard
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Piggy\Api\Exceptions\PiggyRequestException
     */
    public function link(Shop $shop, Member $member, LoyaltyCard $loyaltyCard): LoyaltyCard
    {
        $response = $this->client->post("{$this->resourceUri}/link-loyalty-card", [
            "shop_id" => $shop->getId(),
            "member_id" => $member->getId(),
            "loyalty_card_id" => $loyaltyCard->getId(),
        ]);

        $mapper = new LoyaltyCardMapper();

        return $mapper->map($response->getData());
    }
}
