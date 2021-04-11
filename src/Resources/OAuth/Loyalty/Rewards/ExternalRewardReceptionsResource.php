<?php

namespace Piggy\Api\Resources\OAuth\Loyalty\Rewards;

use Piggy\Api\Mappers\Loyalty\RewardReceptions\ExternalRewardReceptionsMapper;
use Piggy\Api\Models\Loyalty\RewardReceptions\ExternalRewardReception;
use Piggy\Api\Models\Loyalty\Rewards\Reward;
use Piggy\Api\Exceptions\RequestException;
use Piggy\Api\Models\Loyalty\LoyaltyCard;
use Piggy\Api\Models\Shops\Shop;
use Piggy\Api\Resources\BaseResource;

/**
 * Class ExternalRewardReceptionsResource
 * @package Piggy\Api\Resources\OAuth\Loyalty\Rewards
 */
class ExternalRewardReceptionsResource extends BaseResource
{
    /**
     * @var string
     */
    protected $resourceUri = "/api/v2/oauth/clients/rewards/external";

    /**
     * @param Shop $shop
     * @param Reward $reward
     * @param LoyaltyCard $loyaltyCard
     * @return ExternalRewardReception
     * @throws RequestException
     */
    public function create(Shop $shop, Reward $reward, LoyaltyCard $loyaltyCard): ExternalRewardReception
    {
        $response = $this->client->post("{$this->resourceUri}/reward-reception", [
            "shop_id" => $shop->getId(),
            "reward_id" => $reward->getId(),
            "loyalty_card_id" => $loyaltyCard->getId()
        ]);

        $mapper = new ExternalRewardReceptionsMapper();

        return $mapper->map($response->getData());
    }
}
