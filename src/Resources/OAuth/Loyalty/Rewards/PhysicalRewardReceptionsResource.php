<?php

namespace Piggy\Api\Resources\OAuth\Loyalty\Rewards;

use Piggy\Api\Mappers\Loyalty\RewardReceptions\PhysicalRewardReceptionsMapper;
use Piggy\Api\Models\Loyalty\RewardReceptions\PhysicalRewardReception;
use Piggy\Api\Models\Loyalty\Rewards\Reward;
use Piggy\Api\Exceptions\RequestException;
use Piggy\Api\Models\Loyalty\LoyaltyCard;
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
     * @param int $shopId
     * @param Reward $reward
     * @param LoyaltyCard $loyaltyCard
     * @return PhysicalRewardReception
     * @throws RequestException
     */
    public function create(int $shopId, Reward $reward, LoyaltyCard $loyaltyCard): PhysicalRewardReception
    {
        $body = [
            "shop_id" => $shopId,
            "reward_id" => $reward->getId(),
            "loyalty_card_id" => $loyaltyCard->getId()
        ];

        $response = $this->client->post("{$this->resourceUri}/reward-reception", $body);

        $mapper = new PhysicalRewardReceptionsMapper();

        return $mapper->map($response->getData());
    }
}
