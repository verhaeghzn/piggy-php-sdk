<?php

namespace Piggy\Api\Models\Loyalty;

use MyCLabs\Enum\Enum;

/**
 * Class LoyaltyCard
 * @package Piggy\Api\Models\Loyalty
 */
class LoyaltyCard
{

    private $id;

    /**
     * @var string
     */
    private $hash;

    /**
     * @var int
     */
    private $type;

    /**
     * @var int
     */
    private $status;

    /**
     * @var ?Member
     */
    private $member;

    /**
     * LoyaltyCard constructor.
     * @param $id
     * @param string $hash
     * @param int $type
     * @param int $status
     * @param Member|null $member
     */
    public function __construct($id, string $hash, int $type, int $status, Member $member = null)
    {
        $this->id = $id;
        $this->hash = $hash;
        $this->type = $type;
        $this->status = $status;
        $this->member = $member;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getHash(): string
    {
        return $this->hash;
    }

    /**
     * @return int
     */
    public function getType(): int
    {
        return $this->type;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @return Member|null
     */
    public function getMember(): ?Member
    {
        return $this->member;
    }
}
