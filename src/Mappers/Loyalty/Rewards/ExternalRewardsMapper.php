<?php

namespace Piggy\Api\Mappers\Loyalty\Rewards;

/**
 * Class ExternalRewardsMapper
 * @package Piggy\Api\Mappers\Loyalty\Rewards
 */
class ExternalRewardsMapper
{
    /**
     * @param $data
     * @return array
     */
    public function map($data): array
    {
        $externalRewardMapper = new ExternalRewardMapper();

        $externalRewards = [];
        foreach ($data as $item) {
            $externalRewards[] = $externalRewardMapper->map($item);
        }

        return $externalRewards;
    }
}
