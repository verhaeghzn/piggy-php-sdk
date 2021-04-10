<?php

namespace Piggy\Api\Models\Loyalty;

/**
 * Class CreditBalance
 * @package Piggy\Api\Models
 */
class CreditBalance
{

    /**
     * @var Member
     */
    protected $member;

    /**
     * @var CreditBalance
     */
    private $balance;

    /**
     * CreditBalance constructor.
     * @param Member $member
     * @param int $balance
     */
    public function __construct(Member $member, int $balance)
    {
        $this->member = $member;
        $this->balance = $balance;
    }

    /**
     * @return int
     */
    public function getBalance(): int
    {
        return $this->balance;
    }
}
