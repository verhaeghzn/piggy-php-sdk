<?php

namespace Piggy\Api\Mappers\Loyalty\Rewards;

use Piggy\Api\Models\Loyalty\Rewards\PhysicalReward;

/**
 * Class PhysicalRewardMapper
 * @package Piggy\Api\Mappers\Loyalty\Rewards
 */
class PhysicalRewardMapper
{
    /**
     * @param $data
     * @return PhysicalReward
     */
    public function map($data): PhysicalReward
    {
        $active = property_exists($data, 'active') ? $data->active : true;
        $requiredCredits = property_exists($data, 'required_credits') ? $data->required_credits : null;

        $physicalReward = new PhysicalReward(
            $data->id,
            $data->title,
            $active,
            $requiredCredits
        );

        return $physicalReward;
    }
}
