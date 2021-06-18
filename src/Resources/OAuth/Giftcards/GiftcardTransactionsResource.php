<?php

namespace Piggy\Api\Resources\OAuth\Giftcards;

use Piggy\Api\Exceptions\RequestException;
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
     * @param int $giftcardId
     * @param int $amountInCents
     * @param int $shopId
     *
     * @return GiftcardTransaction
     * @throws RequestException
     */
    public function create(int $giftcardId, int $amountInCents, int $shopId): GiftcardTransaction
    {
        $response = $this->client->post($this->resourceUri, [
            "giftcard_id" => $giftcardId,
            "amount" => $amountInCents,
            "shop_id" => $shopId,
        ]);

        $mapper = new GiftcardTransactionMapper();

        return $mapper->map($response->getData());
    }

    /**
     * @param int $giftcardTransactionId
     *
     * @return GiftcardTransaction
     * @throws RequestException
     */
    public function correct(int $giftcardTransactionId): GiftcardTransaction
    {
        $response = $this->client->post($this->resourceUri . "/correct/{$giftcardTransactionId}", []);

        $mapper = new GiftcardTransactionMapper();

        return $mapper->map($response->getData());
    }
}
