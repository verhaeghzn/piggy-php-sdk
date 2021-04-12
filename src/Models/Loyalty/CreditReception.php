<?php

namespace Piggy\Api\Models\Loyalty;

use DateTime;
use Exception;

/**
 * Class CreditReception
 * @package Piggy\Api\Models
 */
class CreditReception
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var int
     */
    protected $credits;

    /**s
     * @var DateTime
     */
    protected $createdAt;

    /**
     * @var Member
     */
    protected $member;

    /**
     * CreditReception constructor.
     * @param int $id
     * @param int $credits
     * @param Member $member
     * @param string $createdAt
     * @throws Exception
     */
    public function __construct(int $id, int $credits, Member $member, string $createdAt)
    {
        $this->id = $id;
        $this->credits = $credits;
        $this->member = $member;
        $this->createdAt = new DateTime($createdAt);
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getCredits(): int
    {
        return $this->credits;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @return Member
     */
    public function getMember(): Member
    {
        return $this->member;
    }
}
