<?php

namespace Piggy\Api\Models;

/**
 * Class StagedCreditReception
 * @package Piggy\Api\Models
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
     * @var string
     */
    protected $createdAt;

    /**
     * @var CreditReception|null
     */
    protected $creditReception;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /**
     * @return string
     */
    public function getHash(): string
    {
        return $this->hash;
    }

    /**
     * @param string $createdAt
     */
    public function setCreatedAt(string $createdAt): void
    {
        $this->createdAt = $createdAt;
    }
    
    /**
     * @param string $hash
     */
    public function setHash(string $hash): void
    {
        $this->hash = $hash;
    }

    /**
     * @return int
     */
    public function getCredits(): int
    {
        return $this->credits;
    }

    /**
     * @param int $credits
     */
    public function setCredits(int $credits): void
    {
        $this->credits = $credits;
    }

    /**
     * @return CreditReception|null
     */
    public function getCreditReception(): ?CreditReception
    {
        return $this->creditReception;
    }

    /**
     * @param CreditReception|null $creditReception
     */
    public function setCreditReception(?CreditReception $creditReception): void
    {
        $this->creditReception = $creditReception;
    }
}