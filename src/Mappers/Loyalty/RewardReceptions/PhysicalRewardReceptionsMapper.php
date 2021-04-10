<?php

namespace Piggy\Api\Mappers\Loyalty\RewardReceptions;

use Piggy\Api\Mappers\Loyalty\MemberMapper;
use Piggy\Api\Mappers\Loyalty\Rewards\PhysicalRewardMapper;
use Piggy\Api\Models\Loyalty\RewardReceptions\PhysicalRewardReception;

/**
 * Class PhysicalRewardReceptionsMapper
 * @package Piggy\Api\Mappers\Loyalty\RewardReceptions
 */
class PhysicalRewardReceptionsMapper
{
    /**
     * @param $data
     * @return PhysicalRewardReception
     */
    public function map($data): PhysicalRewardReception
    {
        $memberMapper = new MemberMapper();
        $member = $memberMapper->map($data->member);

        $physicalRewardMapper = new PhysicalRewardMapper();
        $physicalReward = $physicalRewardMapper->map($data->physical_reward);

        $physicalRewardReception = new PhysicalRewardReception(
            $data->id,
            $data->title,
            $data->credits,
            $member,
            $physicalReward
        );

        return $physicalRewardReception;
    }
}