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
    private $amount;

    /**
     * @var bool
     */
    private $active;

    /**
     * @var ?DateTime
     */
    private $expirationDate;

    /**
     * Giftcard constructor.
     *
     * @param int $id
     * @param string $hash
     * @param int $type
     * @param bool $active
     * @param string|null $expirationDate
     *
     * @throws \Exception
     */
    public function __construct(int $id, string $hash, int $type, bool $active, ?string $expirationDate)
    {
        $this->id = $id;
        $this->hash = $hash;
        $this->type = $type;
        $this->active = $active;
        $this->expirationDate = !empty($expirationDate) ? new DateTime($expirationDate) : null;
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
    public function getType(): int
    {
        return $this->type;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @return DateTime|null
     */
    public function getExpirationDate(): ?DateTime
    {
        return $this->expirationDate;
    }
}
