<?php

namespace Piggy\Api\Mappers\Loyalty\RewardReceptions;

use Piggy\Api\Mappers\Loyalty\MemberMapper;
use Piggy\Api\Mappers\Loyalty\Rewards\DigitalRewardMapper;
use Piggy\Api\Models\Loyalty\RewardReceptions\DigitalRewardReception;

/**
 * Class DigitalRewardReceptionMapper
 * @package Piggy\Api\Mappers\Loyalty\RewardReceptions
 */
class DigitalRewardReceptionMapper
{
    /**
     * @param $data
     * @return DigitalRewardReception
     */
    public function map($data): DigitalRewardReception
    {
        $memberMapper = new MemberMapper();
        $member = $memberMapper->map($data->member);

        $digitalRewardMapper = new DigitalRewardMapper();
        $digitalReward = $digitalRewardMapper->map($data->digital_reward);

        $digitalRewardReception = new DigitalRewardReception(
            $data->id,
            $data->title,
            $data->credits,
            $member,
            $digitalReward
        );

        return $digitalRewardReception;
    }
}