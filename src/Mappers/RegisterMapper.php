<?php

namespace Piggy\Api\Mappers;

use Piggy\Api\Models\Register;

/**
 * Class RegisterMapper
 * @package Piggy\Api\Mappers
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