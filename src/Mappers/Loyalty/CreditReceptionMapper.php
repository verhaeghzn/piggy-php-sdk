<?php

namespace Piggy\Api\Mappers\Loyalty;

use Piggy\Api\Models\CreditReception;

/**
 * Class CreditReceptionMapper
 * @package Piggy\Api\Mappers\Loyalty
 */
class CreditReceptionMapper
{
    /**
     * @param $data
     * @return CreditReception
     */
    public function map($data): CreditReception
    {
        $memberMapper = new MemberMapper();
        $member = $memberMapper->map($data->member);

        $creditReception = new CreditReception(
            $data->id,
            $data->credits,
            $member,
            $data->created_at
        );

        return $creditReception;
    }
}
