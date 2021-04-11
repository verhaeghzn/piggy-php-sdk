<?php

namespace Piggy\Api\Models\Loyalty\RewardReceptions;

use Piggy\Api\Models\Loyalty\Member;
use Piggy\Api\Models\Loyalty\Rewards\PhysicalReward;

/**
 * Class PhysicalRewardReception
 * @package Piggy\Api\Models\Loyalty\RewardReceptions
 */
class PhysicalRewardReception extends RewardReception
{
    /**
     * @var PhysicalReward
     */
    protected $physicalReward;

    public function __construct(int $id, string $title, int $credits, Member $member, PhysicalReward $physicalReward)
    {
        parent::__construct($id, $title, $credits, $member);

        $this->physicalReward = $physicalReward;
    }

    /**
     * @return PhysicalReward
     */
    public function getPhysicalReward(): PhysicalReward
    {
        return $this->physicalReward;
    }
}
