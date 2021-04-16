<?php

namespace Piggy\Api\Mappers\Shops;

use Piggy\Api\Mappers\Loyalty\LoyaltyProgramMapper;
use Piggy\Api\Models\Shops\Webshop;

/**
 * Class WebshopMapper
 * @package Piggy\Api\Mappers
 */
class WebshopMapper
{
    /**
     * @param $data
     * @return Webshop
     */
    public function map($data): Webshop
    {
        $loyaltyProgramMapper = new LoyaltyProgramMapper();

        $loyaltyProgram = null;

        if ($data->loyalty_program) {
            $loyaltyProgram = $loyaltyProgramMapper->map($data->loyalty_program);
        }

        $webshop = new Webshop(
            $data->id,
            $data->name,
            $loyaltyProgram
        );

        return $webshop;
    }
}
