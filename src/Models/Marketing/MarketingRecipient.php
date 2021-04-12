<?php

namespace Piggy\Api\Models\Marketing;

use DateTime;

/**
 * Class MarketingRecipient
 * @package Piggy\Api\Models\Marketing
 */
class MarketingRecipient
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var bool
     */
    protected $subscribed;

    /**
     * @var DateTime
     */
    protected $createdAt;

    /**
     * MarketingRecipient constructor.
     * @param int $id
     * @param string $email
     * @param bool $subscribed
     * @param DateTime $createdAt
     */
    public function __construct(int $id, string $email, bool $subscribed, DateTime $createdAt)
    {
        $this->id = $id;
        $this->email = $email;
        $this->subscribed = $subscribed;
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
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return bool
     */
    public function isSubscribed(): bool
    {
        return $this->subscribed;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }
}