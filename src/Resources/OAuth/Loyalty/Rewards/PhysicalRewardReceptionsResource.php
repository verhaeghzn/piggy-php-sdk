<?php

namespace Piggy\Api\Resources\OAuth\Loyalty\Rewards;

use Piggy\Api\Mappers\Loyalty\RewardReceptions\PhysicalRewardReceptionsMapper;
use Piggy\Api\Models\Loyalty\RewardReceptions\PhysicalRewardReception;
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
     * @param int $rewardId
     * @param int $loyaltyCardId
     *
     * @return PhysicalRewardReception
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Piggy\Api\Exceptions\PiggyRequestException
     */
    public function create(int $shopId, int $rewardId, int $loyaltyCardId): PhysicalRewardReception
    {
        $response = $this->client->post("{$this->resourceUri}/reward-reception", [
            "shop_id" => $shopId,
            "reward_id" => $rewardId,
            "loyalty_card_id" => $loyaltyCardId,
        ]);

        $mapper = new PhysicalRewardReceptionsMapper();

        return $mapper->map($response->getData());
    }
}
