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

    /**
     * @var int|null
     */
    protected $purchaseAmount;

    /**
     * @var Member|null
     */
    protected $member;

    /**s
     * @var DateTime
     */
    protected $createdAt;

    /**
     * CreditReception constructor.
     * @param int $id
     * @param int $credits
     * @param string $createdAt
     * @param int|null $purchaseAmount
     * @param Member|null $member
     * @throws Exception
     */
    public function __construct(int $id, int $credits, string $createdAt,  int $purchaseAmount = null, Member $member = null)
    {
        $this->id = $id;
        $this->credits = $credits;
        $this->createdAt = new DateTime($createdAt);
        $this->purchaseAmount = $purchaseAmount;
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
     * @return int|null
     */
    public function getPurchaseAmount(): ?int
    {
        return $this->purchaseAmount;
    }
}
