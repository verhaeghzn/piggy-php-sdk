<?php

namespace Piggy\Api\Mappers;

use DateTime;
use Exception;
use Piggy\Api\Models\CreditReception;
use Piggy\Api\Models\Member;

/**
 * Class CreditReceptionMapper
 * @package Piggy\Api\Mappers
 */
class CreditReceptionMapper
{
    /**
     * @param $response
     * @return CreditReception
     * @throws Exception
     */
    public function map($response): CreditReception
    {
        $memberMapper = new MemberMapper();
        $member = $memberMapper->map($response->member);

//        $createdAt = new DateTime($response->created_at);
        $creditReception = new CreditReception($response->id, $response->credits, $member, $response->created_at);

        return $creditReception;
    }
}