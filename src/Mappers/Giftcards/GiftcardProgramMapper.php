<?php

namespace Piggy\Api\Mappers\Giftcards;

use Piggy\Api\Models\Giftcards\GiftcardProgram;

/**
 * Class GiftcardMapper
 * @package Piggy\Api\Mappers\Giftcards
 */
class GiftcardProgramMapper
{
    /**
     * @param object $data
     * @return GiftcardProgram
     */
    public function map(object $data): GiftcardProgram
    {
        $giftcard = new GiftcardProgram(
            $data->id,
            $data->name
        );

        return $giftcard;
    }

}