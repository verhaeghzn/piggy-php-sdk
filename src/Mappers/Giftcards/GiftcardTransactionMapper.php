<?php

namespace Piggy\Api\Mappers\Giftcards;

use Piggy\Api\Models\Giftcards\GiftcardTransaction;

/**
 * Class GiftcardTransactionMapper
 * @package Piggy\Api\Mappers\Giftcards
 */
class GiftcardTransactionMapper
{
    /**
     * @param object $data
     *
     * @return GiftcardTransaction
     * @throws \Exception
     */
    public function map(object $data): GiftcardTransaction
    {
        return new GiftcardTransaction(
            $data->id,
            $data->amount_in_cents,
            $data->created_at
        );
    }
}
