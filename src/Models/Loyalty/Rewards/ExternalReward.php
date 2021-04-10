<?php

namespace Piggy\Api\Models\Loyalty\Rewards;

/**
 * Class ExternalReward
 * @package Piggy\Api\Models\Loyalty\Rewards
 */
class ExternalReward extends Reward
{
    /**
     * @var int
     */
    protected $price;

    /**
     * @var int|null
     */
    protected $stock;

    /**
     * @var bool
     */
    protected $active;

    /**
     * ExternalReward constructor.
     * @param $id
     * @param string $title
     * @param int|null $price
     * @param bool $active
     * @param int|null $requiredCredits
     * @param int|null $stock
     */
    public function __construct($id, string $title, ?int $price = null, bool $active = true, ?int $requiredCredits = null,  ?int $stock = null)
    {
        parent::__construct($id, $title, $requiredCredits);

        $this->price = $price;
        $this->stock = $stock;
        $this->active = $active;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @return int|null
     */
    public function getStock(): ?int
    {
        return $this->stock;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @param int $price
     */
    public function setPrice(?int $price): void
    {
        $this->price = $price;
    }

    /**
     * @param int|null $stock
     */
    public function setStock(?int $stock): void
    {
        $this->stock = $stock;
    }

    /**
     * @param bool $active
     */
    public function setActive(bool $active): void
    {
        $this->active = $active;
    }
}