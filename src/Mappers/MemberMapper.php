<?php

namespace Piggy\Api\Mappers;

use Piggy\Api\Model\Member;

/**
 * Class MemberMapper
 * @package Piggy\Api\Mappers
 */
class MemberMapper
{
    /**
     * @param $response
     * @return Member
     */
    public function mapFromResponse($response): Member
    {
        $member = new Member();

        $member->setId($response->id);
        $member->setEmail($response->email);

        return $member;
    }
}