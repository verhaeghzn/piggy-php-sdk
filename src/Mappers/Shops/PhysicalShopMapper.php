<?php

namespace Piggy\Api\Mappers\Shops;

use Piggy\Api\Mappers\Loyalty\LoyaltyProgramMapper;
use Piggy\Api\Models\Shops\PhysicalShop;

/**
 * Class PhysicalShopMapper
 * @package Piggy\Api\Mappers\Shops
 */
class PhysicalShopMapper
{
    /**
     * @param $data
     * @return PhysicalShop
     */
    public function map($data): PhysicalShop
    {
        $loyaltyProgramMapper = new LoyaltyProgramMapper();

        $loyaltyProgram = null;

        if ($data->loyalty_program) {
            $loyaltyProgram = $loyaltyProgramMapper->map($data->loyalty_program);
        }

        $physicalShop = new PhysicalShop(
            $data->id,
            $data->name,
            $loyaltyProgram
        );

        return $physicalShop;
    }
}
