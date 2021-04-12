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
     * @var int|string
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
     * @param $id
     * @param string $hash
     * @param int $type
     * @param bool $active
     * @param bool $upgradeable
     * @param GiftcardProgram $giftcardProgram
     * @param null $expirationDate
     */
    public function __construct($id, string $hash, int $type, bool $active, bool $upgradeable, GiftcardProgram $giftcardProgram, $expirationDate = null)
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
     * @return int|string
     */
    public function getId()
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
     * @return GiftcardProgram
     */
    public function getGiftcardProgram(): GiftcardProgram
    {
        return $this->giftcardProgram;
    }
}