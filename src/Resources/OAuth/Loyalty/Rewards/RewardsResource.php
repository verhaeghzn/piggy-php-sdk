<?php

namespace Piggy\Api\Resources\OAuth\Loyalty\Rewards;

use Piggy\Api\Mappers\Loyalty\Rewards\RewardsMapper;
use Piggy\Api\Resources\BaseResource;

/**
 * Class RewardsResource
 * @package Piggy\Api\Resources\OAuth\Loyalty\Rewards
 */
class RewardsResource extends BaseResource
{
    /**
     * @var string
     */
    protected $resourceUri = "/api/v2/oauth/clients/rewards";

    /**
     * @param int $shopId
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Piggy\Api\Exceptions\PiggyRequestException
     */
    public function all(int $shopId): array
    {
        $response = $this->client->get($this->resourceUri, [
            "shop_id" => $shopId,
        ]);

        $mapper = new RewardsMapper();

        return $mapper->map($response->getData());
    }
}
