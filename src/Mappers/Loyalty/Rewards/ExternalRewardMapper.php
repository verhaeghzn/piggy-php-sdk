<?php

namespace Piggy\Api\Mappers\Loyalty\Rewards;

use Piggy\Api\Models\Loyalty\Rewards\ExternalReward;

/**
 * Class ExternalRewardMapper
 * @package Piggy\Api\Mappers\Loyalty\Rewards
 */
class ExternalRewardMapper
{
    /**
     * @param $data
     * @return ExternalReward
     */
    public function map($data): ExternalReward
    {
        $requiredCredits = property_exists($data, "required_credits") ? $data->required_credits : null;
        $price = property_exists($data, "price") ? $data->price : null;
        $active = property_exists($data, 'active') ? $data->active : true;
        $stock = property_exists($data, 'stock') ? $data->stock : null;

        $externalReward = new ExternalReward(
            $data->id,
            $data->title,
            $price,
            $active,
            $requiredCredits,
            $stock
        );

        return $externalReward;
    }
}
