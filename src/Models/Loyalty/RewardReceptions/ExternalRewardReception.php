<?php

namespace Piggy\Api\Models\Loyalty\RewardReceptions;

use Piggy\Api\Models\Loyalty\Member;
use Piggy\Api\Models\Loyalty\Rewards\ExternalReward;

/**
 * Class ExternalRewardReception
 * @package Piggy\Api\Models\Loyalty\RewardReceptions
 */
class ExternalRewardReception extends RewardReception
{
    /**
     * @var ExternalReward
     */
    protected $externalReward;

    public function __construct($id, string $title, int $credits, Member $member, ExternalReward $externalReward)
    {
        parent::__construct($id, $title, $credits, $member);

        $this->externalReward = $externalReward;
    }

    /**
     * @return ExternalReward
     */
    public function getExternalReward(): ExternalReward
    {
        return $this->externalReward;
    }
}