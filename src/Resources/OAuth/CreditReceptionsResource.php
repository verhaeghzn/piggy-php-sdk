<?php

namespace Piggy\Api\Resources\OAuth;

use Piggy\Api\Exceptions\RequestException;
use Piggy\Api\Mappers\CreditReceptionMapper;
use Piggy\Api\Model\CreditReception;
use Piggy\Api\Model\Member;
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
     */
    public function get(int $id)
    {
        $response = $this->client->request("GET", $this->resourceUri . "/" . $id, []);

        $mapper = new CreditReceptionMapper();

        return $mapper->mapFromResponse($this->getDataFromResponse($response));
    }

    /**
     * @param int $shopId
     * @param int $purchaseAmount
     * @param int|null $memberId
     * @param int|null $loyaltyCardId
     * @return CreditReception|Member
     * @throws RequestException
     */
    public function create(int $shopId, int $purchaseAmount, int $memberId = null, int $loyaltyCardId = null)
    {
        $body = [
            "shop_id" => $shopId,
            "purchase_amount" => $purchaseAmount,
            "member_id" => $memberId,
            "loyalty_card_id" => $loyaltyCardId
        ];

        $response = $this->client->request("POST", $this->resourceUri, $body);

        $mapper = new CreditReceptionMapper();

        return $mapper->mapFromResponse($this->getDataFromResponse($response));
    }
}