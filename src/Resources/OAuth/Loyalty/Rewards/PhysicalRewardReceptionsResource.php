<?php

namespace Piggy\Api\Resources\OAuth\Loyalty\Rewards;

use Piggy\Api\Mappers\Loyalty\RewardReceptions\PhysicalRewardReceptionsMapper;
use Piggy\Api\Models\Loyalty\RewardReceptions\PhysicalRewardReception;
use Piggy\Api\Models\Loyalty\Rewards\Reward;
use Piggy\Api\Exceptions\RequestException;
use Piggy\Api\Models\Loyalty\LoyaltyCard;
use Piggy\Api\Models\Shops\Shop;
use Piggy\Api\Resources\BaseResource;

/**
 * Class PhysicalRewardReceptionsResource
 * @package Piggy\Api\Resources\OAuth\Loyalty\Rewards
 */
class PhysicalRewardReceptionsResource extends BaseResource
{
    /**
     * @var string
     */
    protected $resourceUri = "/api/v2/oauth/clients/rewards/physical";

    /**
     * @param Shop $shop
     * @param Reward $reward
     * @param LoyaltyCard $loyaltyCard
     * @return PhysicalRewardReception
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Piggy\Api\Exceptions\PiggyRequestException
     */
    public function create(Shop $shop, Reward $reward, LoyaltyCard $loyaltyCard): PhysicalRewardReception
    {
        $response = $this->client->post("{$this->resourceUri}/reward-reception", [
            "shop_id" => $shop->getId(),
            "reward_id" => $reward->getId(),
            "loyalty_card_id" => $loyaltyCard->getId()
        ]);

        $mapper = new PhysicalRewardReceptionsMapper();

        return $mapper->map($response->getData());
    }
}
