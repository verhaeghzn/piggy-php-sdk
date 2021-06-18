<?php

namespace Piggy\Api\Models\Giftcards;

use DateTime;

/**
 * Class Giftcard
 * @package Piggy\Api\Models\Giftcards
 */
class Giftcard
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var int
     */
    protected $type;

    /**
     * @var string;
     */
    protected $hash;

    /**
     * @var DateTime|null
     */
    protected $expirationDate;

    /**
     * @var bool
     */
    protected $active;

    /**
     * @var bool
     */
    protected $upgradeable;

    /**
     * @var GiftcardProgram
     */
    protected $giftcardProgram;

    /**
     * Giftcard constructor.
     *
     * @param int $id
     * @param string $hash
     * @param int $type
     * @param bool $active
     * @param bool $upgradeable
     * @param GiftcardProgram|null $giftcardProgram
     * @param DateTime|null $expirationDate
     */
    public function __construct(int $id, string $hash, int $type, bool $active, bool $upgradeable, ?GiftcardProgram $giftcardProgram, ?DateTime $expirationDate)
    {
        $this->id = $id;
        $this->hash = $hash;
        $this->type = $type;
        $this->active = $active;
        $this->upgradeable = $upgradeable;
        $this->giftcardProgram = $giftcardProgram;
        $this->expirationDate = $expirationDate;
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
    public function getType(): int
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getHash(): string
    {
        return $this->hash;
    }

    /**
     * @return DateTime|null
     */
    public function getExpirationDate(): ?DateTime
    {
        return $this->expirationDate;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @return bool
     */
    public function isUpgradeable(): bool
    {
        return $this->upgradeable;
    }

    /**
     * @return GiftcardProgram|null
     */
    public function getGiftcardProgram(): ?GiftcardProgram
    {
        return $this->giftcardProgram;
    }
}