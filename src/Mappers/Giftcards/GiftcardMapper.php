<?php

namespace Piggy\Api\Mappers\Giftcards;

use Piggy\Api\Enum\GiftcardType;
use Piggy\Api\Mappers\BaseMapper;
use Piggy\Api\Models\Giftcards\Giftcard;

/**
 * Class GiftcardMapper
 * @package Piggy\Api\Mappers\Giftcards
 */
class GiftcardMapper extends BaseMapper
{
    /**
     * @param object $data
     * @return Giftcard
     */
    public function map(object $data): Giftcard
    {
        if (isset($data->giftcard_program)) {
            $giftcardProgramMapper = new GiftcardProgramMapper();
            $giftcardProgram = $giftcardProgramMapper->map($data->giftcard_program);
        }

        if(isset($data->expiration_date) && !empty($data->expiration_date)) {
            $expirationDate = $this->parseDate($data->expiration_date);
        }

        $giftcard = new Giftcard(
            $data->id,
            $data->hash,
            GiftcardType::byName($data->type)->getValue(),
            $data->active,
            $data->upgradeable,
            $giftcardProgram ?? null,
            $expirationDate ?? null
        );

        return $giftcard;
    }
}