<?php

namespace Piggy\Api\Models;

use DateTime;

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
     * @var string
     */
    protected $createdAt;

    /**
     * @var Member
     */
    protected $member;

    // Created at > DateTime
    public function __construct($id, int $credits, Member $member, string $createdAt)
    {
        $this->id = $id;
        $this->credits = $credits;
        $this->member = $member;
        $this->createdAt = $createdAt;
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
     * @return string
     */
    public function getCreatedAt(): string
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