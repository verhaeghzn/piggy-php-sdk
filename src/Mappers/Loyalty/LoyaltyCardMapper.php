<?php

namespace Piggy\Api\Mappers\Loyalty;

use Piggy\Api\Enum\CardStatus;
use Piggy\Api\Enum\CardType;
use Piggy\Api\Models\Loyalty\LoyaltyCard;

/**
 * Class LoyaltyCardMapper
 * @package Piggy\Api\Mappers\Loyalty
 */
class LoyaltyCardMapper
{
    /**
     * @param object $data
     * @return LoyaltyCard
     */
    public function map(object $data): LoyaltyCard
    {
        if ($data->member == null) {
            $member = null;
        } else {
            $memberMapper = new MemberMapper();
            $member = $memberMapper->map($data->member);
        }

        $type = $data->type;
        $status = $data->status;

        $loyaltyCard = new LoyaltyCard(
            $data->id,
            $data->hash,
            CardType::$type()->getValue(),
            CardStatus::$status()->getValue(),
            $member
        );

        return $loyaltyCard;
    }
}
