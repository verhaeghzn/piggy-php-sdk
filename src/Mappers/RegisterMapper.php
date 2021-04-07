<?php

namespace Piggy\Api\Mappers;

use Piggy\Api\Model\Register;

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
    public function mapFromResponse($response): Register
    {
        $register = new Register();
        $physicalShopMapper = new PhysicalShopMapper();

        $register->setName($response->name ?? null);
        $register->setShop($physicalShopMapper->mapFromResponse($response->shop));
        $register->setIdentifier($response->identifier);

        return $register;
    }
}