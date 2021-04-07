<?php

namespace Piggy\Api\Mappers;

use Piggy\Api\Model\CreditBalance;

/**
 * Class CreditBalanceMapper
 * @package Piggy\Api\Mappers
 */
class CreditBalanceMapper
{
    /**
     * @param $response
     * @return CreditBalance
     */
    public function mapFromResponse($response): CreditBalance
    {
        $creditBalance = new CreditBalance();

        $creditBalance->setBalance($response->balance);

        return $creditBalance;
    }
}