<?php

namespace Piggy\Api\Mappers\Loyalty\Rewards;

/**
 * Class RewardsMapper
 * @package Piggy\Api\Mappers\Loyalty\Rewards
 */
class RewardsMapper
{
    /**
     * @param $data
     * @return array
     */
    public function map($data): array
    {
        $physicalRewardsMapper = new PhysicalRewardsMapper();
        $externalRewardsMapper = new ExternalRewardsMapper();
        $digitalRewardsMapper = new DigitalRewardsMapper();

        $rewards = [];
        foreach ($data as $key => $item) {
            if ($key == "physical") {
                $rewards["physical"] = $physicalRewardsMapper->map($item);
            }

            if ($key == "external") {
                $rewards["external"] = $externalRewardsMapper->map($item);
            }

            if ($key == "digital") {
                $rewards["digital"] = $digitalRewardsMapper->map($item);
            }
        }

        return $rewards;
    }
}
