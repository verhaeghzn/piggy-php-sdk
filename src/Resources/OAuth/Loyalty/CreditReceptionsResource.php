<?php

namespace Piggy\Api\Resources\OAuth\Loyalty;

use Piggy\Api\Exceptions\InputInvalidException;
use Piggy\Api\Mappers\Loyalty\CreditReceptionMapper;
use Piggy\Api\Models\Loyalty\CreditReception;
use Piggy\Api\Resources\BaseResource;

/**
 * Class CreditReceptionsResource
 * @package Piggy\Api\Resources\OAuth
 */
class CreditReceptionsResource extends BaseResource
{
    /**
     * @var string
     */
    protected $resourceUri = "/api/v2/oauth/clients/credit-receptions";

    /**
     * @param int $id
     * @return CreditReception
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Piggy\Api\Exceptions\PiggyRequestException
     */
    public function get(int $id): CreditReception
    {
        $response = $this->client->get("{$this->resourceUri}/{$id}", []);

        $mapper = new CreditReceptionMapper();

        return $mapper->map($response->getData());
    }

    /**
     * @param int $shopId
     * @param int|null $memberId
     * @param int|null $loyaltyCardId
     * @param int|null $purchaseAmount
     * @param int|null $credits
     *
     * @return CreditReception
     * @throws InputInvalidException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Piggy\Api\Exceptions\PiggyRequestException
     */
    public function create(
        int $shopId,
        int $memberId = null,
        int $loyaltyCardId = null,
        int $purchaseAmount = null,
        int $credits = null
    ): CreditReception {
        if(!$memberId && !$loyaltyCardId) {
            throw new InputInvalidException("Member or LoyaltyCard is required");
        }
        if(!$credits && !$purchaseAmount) {
            throw new InputInvalidException("Purchase amount or credits is required");
        }

        $response = $this->client->post($this->resourceUri, [
            "shop_id" => $shopId,
            "member_id" => $memberId,
            "loyalty_card_id" => $loyaltyCardId,
            "purchase_amount" => $purchaseAmount,
            "credits" => $credits,
        ]);

        $mapper = new CreditReceptionMapper();

        return $mapper->map($response->getData());
    }
}
