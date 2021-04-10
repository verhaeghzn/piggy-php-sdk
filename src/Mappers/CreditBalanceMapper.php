<?php

namespace Piggy\Api\Mappers;

use Piggy\Api\Models\CreditBalance;
use Piggy\Api\Models\Member;

/**
 * Class CreditBalanceMapper
 * @package Piggy\Api\Mappers
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
        $creditBalance = new CreditBalance($member, $data->balance);

        return $creditBalance;
    }
}