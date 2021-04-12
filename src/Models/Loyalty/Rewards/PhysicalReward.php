<?php

namespace Piggy\Api\Models\Loyalty\Rewards;

/**
 * Class PhysicalReward
 * @package Piggy\Api\Models\Loyalty\Rewards
 */
class PhysicalReward extends Reward
{
    /**
     * @var bool
     */
    protected $active;

    public function __construct(int $id, string $title, bool $active = true,  ?int $requiredCredits = null)
    {
        parent::__construct($id, $title, $requiredCredits);

        $this->active = $active;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }
}