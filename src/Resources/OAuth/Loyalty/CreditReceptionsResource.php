<?php

namespace Piggy\Api\Resources\OAuth\Loyalty;

use Piggy\Api\Exceptions\InputInvalidException;
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
     * @param Shop $shop
     * @param Member|null $member
     * @param LoyaltyCard|null $loyaltyCard
     * @param int|null $credits
     * @param int|null $purchaseAmount
     * @return CreditReception
     * @throws InputInvalidException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Piggy\Api\Exceptions\PiggyRequestException
     */
    public function create(
        Shop $shop,
        Member $member = null,
        LoyaltyCard $loyaltyCard = null,
        int $purchaseAmount = null,
        int $credits = null
    ): CreditReception {
        if(!$member && !$loyaltyCard) {
            throw new InputInvalidException("Member or LoyaltyCard is required");
        }
        if(!$credits && !$purchaseAmount) {
            throw new InputInvalidException("Purchase amount or credits is required");
        }

        $response = $this->client->post($this->resourceUri, [
            "shop_id" => $shop->getId(),
            "member_id" => $member ? $member->getId() : null,
            "loyalty_card_id" => $loyaltyCard ? $loyaltyCard->getId() : null,
            "purchase_amount" => $purchaseAmount ?: null,
            "credits" => $credits ?: null
        ]);

        $mapper = new CreditReceptionMapper();

        return $mapper->map($response->getData());
    }
}
