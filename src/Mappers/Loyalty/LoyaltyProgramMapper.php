<?php

namespace Piggy\Api\Mappers\Loyalty;

use Piggy\Api\Enum\CardStatus;
use Piggy\Api\Enum\CardType;
use Piggy\Api\Models\Loyalty\LoyaltyCard;
use Piggy\Api\Models\Loyalty\LoyaltyProgram;

/**
 * Class LoyaltyProgramMapper
 * @package Piggy\Api\Mappers\Loyalty
 */
class LoyaltyProgramMapper
{
    /**
     * @param object $data
     * @return LoyaltyProgram
     */
    public function map(object $data): LoyaltyProgram
    {
        $loyaltyCard = new LoyaltyProgram(
            $data->id,
            $data->name
        );

        return $loyaltyCard;
    }
}