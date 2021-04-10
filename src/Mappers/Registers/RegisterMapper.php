<?php

namespace Piggy\Api\Mappers\Registers;

use Piggy\Api\Mappers\Shops\PhysicalShopMapper;
use Piggy\Api\Models\Registers\Register;

/**
 * Class RegisterMapper
 * @package Piggy\Api\Mappers\Registers
 */
class RegisterMapper
{
    /**
     * @param $response
     * @return Register
     */
    public function map($response): Register
    {
        $register = new Register();
        $physicalShopMapper = new PhysicalShopMapper();

        $register->setName($response->name ?? null);
        $register->setShop($physicalShopMapper->map($response->shop));
        $register->setIdentifier($response->identifier);

        return $register;
    }
}
