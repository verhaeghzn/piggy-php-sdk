<?php

namespace Piggy\Api\Resources\OAuth\Loyalty\Rewards;

use Piggy\Api\Exceptions\RequestException;
use Piggy\Api\Mappers\Loyalty\RewardReceptions\DigitalRewardReceptionMapper;
use Piggy\Api\Models\Loyalty\LoyaltyCard;
use Piggy\Api\Models\Loyalty\RewardReceptions\DigitalRewardReception;
use Piggy\Api\Models\Loyalty\Rewards\Reward;
use Piggy\Api\Models\Shops\Shop;
use Piggy\Api\Resources\BaseResource;

/**
 * Class DigitalRewardReceptionsResource
 * @package Piggy\Api\Resources\OAuth\Loyalty\Rewards
 */
class DigitalRewardReceptionsResource extends BaseResource
{
    /**
     * @var string
     */
    protected $resourceUri = "/api/v2/oauth/clients/rewards/digital";

    /**
     * @param Shop $shop
     * @param Reward $reward
     * @param LoyaltyCard $loyaltyCard
     * @return DigitalRewardReception
     * @throws RequestException
     */
    public function create(Shop $shop, Reward $reward, LoyaltyCard $loyaltyCard): DigitalRewardReception
    {
        $response = $this->client->post("{$this->resourceUri}/reward-reception", [
            "shop_id" => $shop->getId(),
            "reward_id" => $reward->getId(),
            "loyalty_card_id" => $loyaltyCard->getId()
        ]);

        $mapper = new DigitalRewardReceptionMapper();

        return $mapper->map($response->getData());
    }
}
