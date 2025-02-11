<?php

namespace Piggy\Api\Mappers\Loyalty;

use Piggy\Api\Models\Loyalty\MemberResponse;

/**
 * Class MemberAndCreditBalanceResponseMapper
 * @package Piggy\Api\Mappers
 */
class MemberAndCreditBalanceResponseMapper
{
    /**
     * @param object $data
     * @return MemberResponse
     */
    public function map(object $data): MemberResponse
    {
        $memberMapper = new MemberMapper();
        $member = $memberMapper->map($data->member);

        if ($data->credit_balance == null) {
            $creditBalance = null;
        } else {
            $creditBalanceMapper = new CreditBalanceMapper();
            $creditBalance = $creditBalanceMapper->map($member, $data->credit_balance);
        }

        $memberResponse = new MemberResponse($member, $creditBalance);

        return $memberResponse;
    }
}
