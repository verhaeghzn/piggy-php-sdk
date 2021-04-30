<?php

namespace Piggy\Api\Mappers\Loyalty;

use Exception;
use Piggy\Api\Mappers\BaseMapper;
use Piggy\Api\Models\Loyalty\StagedCreditReception;

/**
 * Class StagedCreditReceptionMapper
 * @package Piggy\Api\Mappers\Loyalty
 */
class StagedCreditReceptionMapper extends BaseMapper
{
    /**
     * @param object $data
     * @return StagedCreditReception
     * @throws Exception
     */
    public function map(object $data): StagedCreditReception
    {
        $creditReceptionMapper = new CreditReceptionMapper();

        if (property_exists($data, "credit_reception")) {
            $creditReception = $creditReceptionMapper->map($data->credit_reception);
        } else {
            $creditReception = null;
        }

        $stagedCreditReception = new StagedCreditReception(
            $data->id,
            $data->credits,
            $this->parseDate($data->created_at),
            $creditReception
        );

        return $stagedCreditReception;
    }
}
