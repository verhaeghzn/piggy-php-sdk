<?php

namespace Piggy\Api\Resources\OAuth\Shops;

use Piggy\Api\Exceptions\RequestException;
use Piggy\Api\Mappers\Loyalty\CreditReceptionMapper;
use Piggy\Api\Mappers\Shops\ShopsMapper;
use Piggy\Api\Models\Loyalty\CreditReception;
use Piggy\Api\Resources\BaseResource;

/**
 * Class ShopsResource
 * @package Piggy\Api\Resources\OAuth\Shops
 */
class ShopsResource extends BaseResource
{
    /**
     * @var string
     */
    protected $resourceUri = "/api/v2/oauth/clients/shops";

    /**
     * @param int $id
     * @return array
     * @throws RequestException
     */
    public function get(int $id): array
    {
        $response = $this->client->get("{$this->resourceUri}/{$id}", []);

        $mapper = new ShopsMapper();

        return $mapper->map($response->getData());
    }

    /**
     * @param int $shopId
     * @param int $purchaseAmount
     * @param int|null $memberId
     * @param int|null $loyaltyCardId
     * @return CreditReception
     * @throws RequestException
     */
    public function create(
        int $shopId,
        int $purchaseAmount,
        int $memberId = null,
        int $loyaltyCardId = null
    ): CreditReception {
        $body = [
            "shop_id" => $shopId,
            "purchase_amount" => $purchaseAmount,
            "member_id" => $memberId,
            "loyalty_card_id" => $loyaltyCardId
        ];

        $response = $this->client->post($this->resourceUri, $body);

        $mapper = new CreditReceptionMapper();

        return $mapper->map($response->getData());
    }
}
