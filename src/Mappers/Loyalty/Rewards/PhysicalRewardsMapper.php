<?php

namespace Piggy\Api\Mappers\Loyalty\Rewards;

/**
 * Class PhysicalRewardsMapper
 * @package Piggy\Api\Mappers\Loyalty\Rewards
 */
class PhysicalRewardsMapper
{
    /**
     * @param $data
     * @return array
     */
    public function map($data): array
    {
        $physicalRewardMapper = new PhysicalRewardMapper();

        $physicalRewards = [];
        foreach ($data as $item) {
            $physicalRewards[] = $physicalRewardMapper->map($item);
        }

        return $physicalRewards;
    }
}
