<?php

namespace Piggy\Api\Mappers;

use Piggy\Api\Model\CreditReception;
use Piggy\Api\Model\Member;

/**
 * Class CreditReceptionMapper
 * @package Piggy\Api\Mappers
 */
class CreditReceptionMapper
{
    /**
     * @param $response
     * @return Member
     */
    public function mapFromResponse($response): CreditReception
    {
        $creditReception = new CreditReception();
        $memberMapper = new MemberMapper();

        $creditReception->setId($response->id);
        $creditReception->setCredits($response->credits);
        $creditReception->setCreatedAt($response->created_at);
        $creditReception->setMember($memberMapper->mapFromResponse($response->member));

        return $creditReception;
    }
}