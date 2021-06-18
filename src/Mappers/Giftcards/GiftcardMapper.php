<?php

namespace Piggy\Api\Mappers\Giftcards;

use Piggy\Api\Enum\GiftcardType;
use Piggy\Api\Models\Giftcards\Giftcard;

/**
 * Class GiftcardMapper
 * @package Piggy\Api\Mappers\Giftcards
 */
class GiftcardMapper
{
    /**
     * @param object $data
     *
     * @return Giftcard
     * @throws \Exception
     */
    public function map(object $data): Giftcard
    {
        return new Giftcard(
            $data->id,
            $data->hash,
            GiftcardType::byName($data->type)->getValue(),
            $data->active,
            $data->expiration_date
        );
    }
}
