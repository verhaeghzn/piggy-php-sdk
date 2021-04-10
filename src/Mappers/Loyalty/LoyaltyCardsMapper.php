<?php

namespace Piggy\Api\Mappers\Loyalty;

/**
 * Class LoyaltyCardsMapper
 * @package Piggy\Api\Mappers\Loyalty
 */
class LoyaltyCardsMapper
{
    /**
     * @param $data
     * @return array
     */
    public function map($data): array
    {
        $cardMapper = new LoyaltyCardMapper();

        $loyaltyCards = [];
        foreach ($data as $item) {
            $loyaltyCards[] = $cardMapper->map($item);
        }

        return $loyaltyCards;
    }
}
