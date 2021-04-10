<?php

namespace Piggy\Api\Mappers\Loyalty;

use Piggy\Api\Models\Loyalty\Member;

/**
 * Class MemberMapper
 * @package Piggy\Api\Mappers\Loyalty
 */
class MemberMapper
{
    /**
     * @param object $data
     * @return Member
     */
    public function map(object $data): Member
    {
        $member = new Member(
            $data->id,
            $data->email
        );

        return $member;
    }
}
