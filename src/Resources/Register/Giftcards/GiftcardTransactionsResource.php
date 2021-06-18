<?php

namespace Piggy\Api\Resources\Register\Giftcards;

use Piggy\Api\Exceptions\RequestException;
use Piggy\Api\Mappers\Giftcards\GiftcardTransactionMapper;
use Piggy\Api\Models\Giftcards\GiftcardTransaction;
use Piggy\Api\Resources\BaseResource;

/**
 * Class GiftcardTransactionsResource
 * @package Piggy\Api\Resources\Register\Giftcards
 */
class GiftcardTransactionsResource extends BaseResource
{
    /**
     * @var string
     */
    protected $resourceUri = "/api/v1/register/giftcard-transactions";

    /**
     * @param int $giftcardId
     * @param int $amountInCents
     *
     * @return GiftcardTransaction
     * @throws RequestException
     */
    public function create(int $giftcardId, int $amountInCents): GiftcardTransaction
    {
        $response = $this->client->post($this->resourceUri, [
            "giftcard_id" => $giftcardId,
            "amount" => $amountInCents,
        ]);

        $mapper = new GiftcardTransactionMapper();

        return $mapper->map($response->getData());
    }
}
