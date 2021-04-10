<?php

namespace Piggy\Api\Resources\OAuth\Loyalty\Rewards;

use Piggy\Api\Mappers\Loyalty\RewardReceptions\ExternalRewardReceptionsMapper;
use Piggy\Api\Models\Loyalty\RewardReceptions\ExternalRewardReception;
use Piggy\Api\Models\Loyalty\Rewards\Reward;
use Piggy\Api\Exceptions\RequestException;
use Piggy\Api\Models\Loyalty\LoyaltyCard;
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
     * @param int $shopId
     * @param Reward $reward
     * @param LoyaltyCard $loyaltyCard
     * @return ExternalRewardReception
     * @throws RequestException
     */
    public function create(int $shopId, Reward $reward, LoyaltyCard $loyaltyCard): ExternalRewardReception
    {
        $body = [
            "shop_id" => $shopId,
            "reward_id" => $reward->getId(),
            "loyalty_card_id" => $loyaltyCard->getId()
        ];

        $response = $this->client->post("{$this->resourceUri}/reward-reception", $body);

        $mapper = new ExternalRewardReceptionsMapper();

        return $mapper->map($response->getData());
    }
}
