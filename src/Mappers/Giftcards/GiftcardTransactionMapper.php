<?php

namespace Piggy\Api\Mappers\Giftcards;

use Piggy\Api\Mappers\BaseMapper;
use Piggy\Api\Models\Giftcards\GiftcardTransaction;

/**
 * Class GiftcardTransactionMapper
 * @package Piggy\Api\Mappers\Giftcards
 */
class GiftcardTransactionMapper extends BaseMapper
{
    /**
     * @param object $data
     * @return GiftcardTransaction
     */
    public function map(object $data): GiftcardTransaction
    {
        $giftcardTransaction = new GiftcardTransaction(
            $data->id,
            $data->amount_in_cents,
            $this->parseDate($data->created_at)
        );

        return $giftcardTransaction;
    }
}