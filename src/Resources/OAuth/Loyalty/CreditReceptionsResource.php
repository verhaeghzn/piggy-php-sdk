<?php

namespace Piggy\Api\Resources\OAuth\Loyalty;

use Piggy\Api\Exceptions\BadResponseException;
use Piggy\Api\Exceptions\RequestException;
use Piggy\Api\Mappers\Loyalty\CreditReceptionMapper;
use Piggy\Api\Models\Loyalty\CreditReception;
use Piggy\Api\Models\Loyalty\LoyaltyCard;
use Piggy\Api\Models\Loyalty\Member;
use Piggy\Api\Models\Shops\Shop;
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
     * @throws RequestException
     */
    public function get(int $id): CreditReception
    {
        $response = $this->client->get("{$this->resourceUri}/{$id}", []);

        $mapper = new CreditReceptionMapper();

        return $mapper->map($response->getData());
    }

    /**
     * @param Shop $shop
     * @param Member $member
     * @param int $purchaseAmount
     * @param LoyaltyCard|null $loyaltyCard
     * @return CreditReception
     * @throws RequestException
     */
    public function create(
        Shop $shop,
        Member $member,
        int $purchaseAmount,
        ?LoyaltyCard $loyaltyCard = null
    ): CreditReception {
        $body = [
            "shop_id" => $shop->getId(),
            "member_id" => $member->getId(),
            "purchase_amount" => $purchaseAmount,
            "loyalty_card_id" => $loyaltyCard->getId(),
        ];

        $response = $this->client->post($this->resourceUri, $body);

        $mapper = new CreditReceptionMapper();

        return $mapper->map($response->getData());
    }
}
