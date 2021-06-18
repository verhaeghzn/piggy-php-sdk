<?php

namespace Piggy\Api\Models\Giftcards;

use DateTime;

/**
 * Class GiftcardTransaction
 * @package Piggy\Api\Models\Giftcards
 */
class GiftcardTransaction
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $amountInCents;

    /**
     * @var DateTime
     */
    private $createdAt;

    /**
     * GiftcardTransaction constructor.
     *
     * @param int $id
     * @param int $amountInCents
     * @param string $createdAt
     *
     * @throws \Exception
     */
    public function __construct(int $id, int $amountInCents, string $createdAt)
    {
        $this->id = $id;
        $this->amountInCents = $amountInCents;
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
    public function getAmountInCents(): int
    {
        return $this->amountInCents;
    }

    /**
     * @return int
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }
}
