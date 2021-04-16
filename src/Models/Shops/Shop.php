<?php

namespace Piggy\Api\Models\Shops;

use Piggy\Api\Models\Loyalty\LoyaltyProgram;

/**
 * Class Shop
 * @package Piggy\Api\Models\Shops
 */
abstract class Shop
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var LoyaltyProgram|null $loyaltyProgram
     */
    protected $loyaltyProgram;

    /**
     * Shop constructor.
     * @param int $id
     * @param string $name
     */
    public function __construct(int $id, string $name, LoyaltyProgram $loyaltyProgram = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->loyaltyProgram = $loyaltyProgram;
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
    public function getName(): string
    {
        return $this->name;
    }
    
    /**
     * @return LoyaltyProgram|null
     */
    public function getLoyaltyProgram(): ?LoyaltyProgram
    {
        return $this->loyaltyProgram;
    }
}
