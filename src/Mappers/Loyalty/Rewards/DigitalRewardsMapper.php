<?php

namespace Piggy\Api\Mappers\Loyalty\Rewards;

/**
 * Class DigitalRewardsMapper
 * @package Piggy\Api\Mappers\Loyalty
 */
class DigitalRewardsMapper
{
    /**
     * @param $data
     * @return array
     */
    public function map($data): array
    {
        $digitalRewardMapper = new DigitalRewardMapper();

        $digitalRewards = [];
        foreach ($data as $item) {
            $digitalRewards[] = $digitalRewardMapper->map($item);
        }

        return $digitalRewards;
    }
}
