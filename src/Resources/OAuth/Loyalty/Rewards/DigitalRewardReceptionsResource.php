<?php

namespace Piggy\Api\Resources\OAuth\Loyalty\Rewards;

use Piggy\Api\Mappers\Loyalty\RewardReceptions\DigitalRewardReceptionMapper;
use Piggy\Api\Models\Loyalty\RewardReceptions\DigitalRewardReception;
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
     * @param int $shopId
     * @param int $digitalRewardId
     * @param int $loyaltyCardId
     *
     * @return DigitalRewardReception
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Piggy\Api\Exceptions\PiggyRequestException
     */
    public function create(int $shopId, int $digitalRewardId, int $loyaltyCardId): DigitalRewardReception
    {
        $response = $this->client->post("{$this->resourceUri}/reward-reception", [
            "shop_id" => $shopId,
            "reward_id" => $digitalRewardId,
            "loyalty_card_id" => $loyaltyCardId,
        ]);

        $mapper = new DigitalRewardReceptionMapper();

        return $mapper->map($response->getData());
    }
}
