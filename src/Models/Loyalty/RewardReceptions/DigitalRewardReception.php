<?php

namespace Piggy\Api\Models\Loyalty\RewardReceptions;

use Piggy\Api\Models\Loyalty\Member;
use Piggy\Api\Models\Loyalty\Rewards\DigitalReward;

/**
 * Class DigitalRewardReception
 * @package Piggy\Api\Models\Loyalty\RewardReceptions
 */
class DigitalRewardReception extends RewardReception
{
    /**
     * @var DigitalReward
     */
    protected $digitalReward;

    public function __construct(int $id, string $title, int $credits, Member $member, DigitalReward $digitalReward)
    {
        parent::__construct($id, $title, $credits, $member);
        $this->digitalReward = $digitalReward;
    }

    /**
     * @return DigitalReward
     */
    public function getDigitalReward(): DigitalReward
    {
        return $this->digitalReward;
    }
}
