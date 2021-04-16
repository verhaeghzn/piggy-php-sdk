<?php

namespace Piggy\Api\Models\Loyalty;

/**
 * Class LoyaltyProgram
 * @package Piggy\Api\Models\Loyalty
 */
class LoyaltyProgram
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
     * Member constructor.
     * @param int $id
     * @param string $name
     */
    public function __construct(int $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
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
}
