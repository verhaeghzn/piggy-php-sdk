<?php

namespace Piggy\Api\Model;

/**
 * Class CreditBalance
 * @package Piggy\Api\Model
 */
class CreditBalance
{
//    /**
//     * @var int
//     */
//    protected $id;

    /**
     * @var int
     */
    protected $balance;

//    /**
//     * @var Member
//     */
//    protected $member;
//
//    /**
//     * @var LoyaltyProgram
//     */
//    protected $loyaltyProgram;

    /**
     * @return int
     */
    public function getBalance(): int
    {
        return $this->balance;
    }

    /**
     * @param int $balance
     */
    public function setBalance(int $balance): void
    {
        $this->balance = $balance;
    }
}