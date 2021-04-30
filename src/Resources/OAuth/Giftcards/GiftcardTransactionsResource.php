<?php

namespace Piggy\Api\Resources\OAuth\Giftcards;

use Piggy\Api\Mappers\Giftcards\GiftcardTransactionMapper;
use Piggy\Api\Models\Giftcards\Giftcard;
use Piggy\Api\Models\Giftcards\GiftcardTransaction;
use Piggy\Api\Models\Shops\Shop;
use Piggy\Api\Resources\BaseResource;

/**
 * Class GiftcardTransactionsResource
 * @package Piggy\Api\Resources\OAuth\Giftcards
 */
class GiftcardTransactionsResource extends BaseResource
{
    /**
     * @var string
     */
    protected $resourceUri = "/api/v2/oauth/clients/giftcard-transactions";

    /**
     * @param Shop $shop
     * @param Giftcard $giftcard
     * @param int $amount
     * @return GiftcardTransaction
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Piggy\Api\Exceptions\PiggyRequestException
     */
    public function create(Shop $shop, Giftcard $giftcard, int $amount): GiftcardTransaction
    {
        $response = $this->client->post($this->resourceUri, [
            "shop_id" => $shop->getId(),
            "giftcard_id" => $giftcard->getId(),
            "amount" => $amount
        ]);

        $mapper = new GiftcardTransactionMapper();

        return $mapper->map($response->getData());
    }
}
