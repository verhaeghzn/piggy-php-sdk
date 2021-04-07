<?php

namespace Piggy\Api\Mappers;

use Piggy\Api\Model\MemberResponse;

/**
 * Class MemberResponseMapper
 * @package Piggy\Api\Mappers
 */
class MemberResponseMapper
{
    /**
     * @param $response
     * @return MemberResponse
     */
    public function mapFromResponse($response): MemberResponse
    {
        $memberMapper = new MemberMapper();
        $creditBalanceMapper = new CreditBalanceMapper();

        $member = $memberMapper->mapFromResponse($response->member);
        $creditBalance = $response->credit_balance ? $creditBalanceMapper->mapFromResponse($response->credit_balance) : null;

        $memberResponse = new MemberResponse($member, $creditBalance);

        return $memberResponse;
    }
}