<?php

namespace Piggy\Api\Models\Loyalty;

use DateTime;

/**
 * Class StagedCreditReception
 * @package Piggy\Api\Models\Loyalty
 */
class StagedCreditReception
{

    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $hash;

    /**
     * @var int
     */
    protected $credits;

    /**
     * @var DateTime
     */
    protected $createdAt;

    /**
     * @var CreditReception|null
     */
    protected $creditReception;

    /**
     * StagedCreditReception constructor.
     * @param int $id
     * @param int $credits
     * @param CreditReception|null $creditReception
     * @param DateTime $createdAt
     */
    public function __construct(
        int $id,
        int $credits,
        DateTime $createdAt,
        ?CreditReception $creditReception = null
    ) {
        $this->id = $id;
        $this->credits = $credits;
        $this->createdAt = $createdAt;
        $this->creditReception = $creditReception;
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
    public function getHash(): string
    {
        return $this->hash;
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
     * @return CreditReception|null
     */
    public function getCreditReception(): ?CreditReception
    {
        return $this->creditReception;
    }
}
