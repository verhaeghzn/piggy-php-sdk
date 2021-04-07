<?php

namespace Piggy\Api\Mappers;

use Piggy\Api\Model\StagedCreditReception;

/**
 * Class StagedCreditReceptionMapper
 * @package Piggy\Api\Mappers
 */
class StagedCreditReceptionMapper
{
    /**
     * @param $response
     * @return StagedCreditReception
     */
    public function mapFromResponse($response): StagedCreditReception
    {
        $stagedCreditReception = new StagedCreditReception();
        $creditReceptionMapper = new CreditReceptionMapper();

        $stagedCreditReception->setId($response->id);
        $stagedCreditReception->setCredits($response->credits);
        $stagedCreditReception->setCreatedAt($response->created_at);
        $stagedCreditReception->setCreditReception($response->credit_reception ? $creditReceptionMapper->mapFromResponse($response->credit_reception) : null);

        return $stagedCreditReception;
    }
}