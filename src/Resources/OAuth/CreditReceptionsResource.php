<?php

namespace Piggy\Api\Resources\OAuth;

use Piggy\Api\Exceptions\BadResponseException;
use Piggy\Api\Exceptions\RequestException;
use Piggy\Api\Mappers\CreditReceptionMapper;
use Piggy\Api\Models\CreditReception;
use Piggy\Api\Models\Member;
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
     * @return CreditReception|Member
     * @throws RequestException
     * @throws BadResponseException
     */
    public function get(int $id): CreditReception
    {
        $response = $this->client->get($this->resourceUri . "/" . $id, []);

        $mapper = new CreditReceptionMapper();

        return $mapper->map($response->getData());
    }

    /**
     * @param int $shopId
     * @param int $purchaseAmount
     * @param int|null $memberId
     * @param int|null $loyaltyCardId
     * @return CreditReception|Member
     * @throws BadResponseException
     * @throws RequestException
     */
    public function create(int $shopId, int $purchaseAmount, int $memberId = null, int $loyaltyCardId = null): CreditReception
    {
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