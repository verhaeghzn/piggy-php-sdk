<?php

namespace Piggy\Api\Mappers;

use Exception;
use Piggy\Api\Mappers\Loyalty\MemberMapper;
use Piggy\Api\Models\Loyalty\CreditReception;

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

        $creditReception = new CreditReception($response->id, $response->credits, $member, $response->created_at);

        return $creditReception;
    }
}