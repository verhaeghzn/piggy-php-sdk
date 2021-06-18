<?php

namespace Piggy\Api\Resources\OAuth\Loyalty\Rewards;

use Piggy\Api\Mappers\Loyalty\RewardReceptions\ExternalRewardReceptionsMapper;
use Piggy\Api\Models\Loyalty\RewardReceptions\ExternalRewardReception;
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
     * @param int $externalRewardId
     * @param int $loyaltyCardId
     *
     * @return ExternalRewardReception
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Piggy\Api\Exceptions\PiggyRequestException
     */
    public function create(int $shopId, int $externalRewardId, int $loyaltyCardId): ExternalRewardReception
    {
        $response = $this->client->post("{$this->resourceUri}/reward-reception", [
            "shop_id" => $shopId,
            "reward_id" => $externalRewardId,
            "loyalty_card_id" => $loyaltyCardId,
        ]);

        $mapper = new ExternalRewardReceptionsMapper();

        return $mapper->map($response->getData());
    }
}
