<?php

namespace Piggy\Api\Resources\OAuth\Giftcards;

use Piggy\Api\Mappers\Giftcards\GiftcardTransactionMapper;
use Piggy\Api\Models\Giftcards\GiftcardTransaction;
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
     * @param int $shopId
     * @param int $giftcardId
     * @param int $amountInCents
     *
     * @return GiftcardTransaction
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Piggy\Api\Exceptions\PiggyRequestException
     */
    public function create(int $shopId, int $giftcardId, int $amountInCents): GiftcardTransaction
    {
        $response = $this->client->post($this->resourceUri, [
            "shop_id" => $shopId,
            "giftcard_id" => $giftcardId,
            "amount" => $amountInCents,
        ]);

        $mapper = new GiftcardTransactionMapper();

        return $mapper->map($response->getData());
    }

    /**
     * @param int $giftcardTransactionId
     *
     * @return GiftcardTransaction
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Piggy\Api\Exceptions\PiggyRequestException
     */
    public function correct(int $giftcardTransactionId): GiftcardTransaction
    {
        $response = $this->client->post($this->resourceUri . "/correct/{$giftcardTransactionId}", []);

        $mapper = new GiftcardTransactionMapper();

        return $mapper->map($response->getData());
    }
}
