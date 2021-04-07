<?php

namespace Piggy\Api\Model;

/**
 * Class MemberResponse
 * @package Piggy\Api\Model
 */
class MemberResponse
{
    /**
     * @var Member
     */
    private $member;
    /**
     * @var CreditBalance|null
     */
    private $creditBalance = null;

    /**
     * MemberResponse constructor.
     * @param Member $member
     * @param CreditBalance|null $creditBalance
     */
    public function __construct(Member $member, CreditBalance $creditBalance = null)
    {
        $this->member = $member;
        $this->creditBalance = $creditBalance;
    }

    /**
     * @return Member
     */
    public function getMember(): Member
    {
        return $this->member;
    }

    /**
     * @return CreditBalance|null
     */
    public function getCreditBalance(): ?CreditBalance
    {
        return $this->creditBalance;
    }
}