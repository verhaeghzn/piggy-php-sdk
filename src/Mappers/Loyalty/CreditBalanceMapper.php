<?php

namespace Piggy\Api\Mappers\Loyalty;

use Piggy\Api\Models\CreditBalance;
use Piggy\Api\Models\Member;

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
