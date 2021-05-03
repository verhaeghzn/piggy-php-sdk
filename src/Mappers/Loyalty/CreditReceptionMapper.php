<?php

namespace Piggy\Api\Mappers\Loyalty;

use Exception;
use Piggy\Api\Models\Loyalty\CreditReception;

/**
 * Class CreditReceptionMapper
 * @package Piggy\Api\Mappers\Loyalty
 */
class CreditReceptionMapper
{
    /**
     * @param $data
     * @return CreditReception
     * @throws Exception
     */
    public function map($data): CreditReception
    {
        if(isset($data->member)) {
            $mapper = new MemberMapper();
            $member = $mapper->map($data->member);
        } else {
            $member = null;
        }

        $creditReception = new CreditReception(
            $data->id,
            $data->credits,
            $data->created_at,
            $data->purchase_amount ?? null,
            $member
        );

        return $creditReception;
    }
}
