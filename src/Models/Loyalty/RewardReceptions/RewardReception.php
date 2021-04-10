<?php

namespace Piggy\Api\Models\Loyalty\RewardReceptions;

use Piggy\Api\Models\Loyalty\Member;

/**
 * Class RewardReception
 * @package Piggy\Api\Models\Loyalty\RewardReceptions
 */
class RewardReception
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var int
     */
    protected $credits;

    /**
     * @var Member
     */
    protected $member;

    public function __construct($id, string $title, int $credits, Member $member)
    {
        $this->id = $id;
        $this->title = $title;
        $this->credits = $credits;
        $this->member = $member;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return int
     */
    public function getCredits(): int
    {
        return $this->credits;
    }

    /**
     * @return Member
     */
    public function getMember(): Member
    {
        return $this->member;
    }
}