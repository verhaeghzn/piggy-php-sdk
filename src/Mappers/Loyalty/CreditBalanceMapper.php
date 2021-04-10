<?php

namespace Piggy\Api\Mappers\Loyalty;

use Piggy\Api\Models\Loyalty\CreditBalance;
use Piggy\Api\Models\Loyalty\Member;

/**
 * Class CreditBalanceMapper
 * @package Piggy\Api\Mappers\Loyalty
 */
class CreditBalanceMapper
{
    /**
     * @param Member $member
     * @param object $data
     * @return CreditBalance
     */
    public function map(Member $member, object $data): CreditBalance
    {
        return new CreditBalance($member, $data->balance);
    }
}
