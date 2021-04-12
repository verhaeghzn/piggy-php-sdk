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
    protected $id;

    /**
     * @var int
     */
    protected $amount;

    /**
     * @var DateTime
     */
    protected $created_at;

    public function __construct(int $id, int $amount, DateTime $created_at)
    {
        $this->id = $id;
        $this->amount = $amount;
        $this->created_at = $created_at;
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
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->created_at;
    }
}