<?php

namespace Piggy\Api\Mappers\Loyalty\Rewards;

use Piggy\Api\Models\Loyalty\Rewards\DigitalReward;

/**
 * Class DigitalRewardMapper
 * @package Piggy\Api\Mappers\Shops
 */
class DigitalRewardMapper
{
    /**
     * @param $data
     * @return DigitalReward
     */
    public function map($data): DigitalReward
    {
        $requiredCredits = property_exists($data, "required_credits") ? $data->required_credits : null;
        $meta = property_exists($data, "meta") ? $data->meta : null;

        $digitalReward = new DigitalReward(
            $data->id,
            $data->title
        );

        return $digitalReward;
    }
}
