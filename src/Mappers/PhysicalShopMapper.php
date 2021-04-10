<?php

namespace Piggy\Api\Mappers;

use Piggy\Api\Models\PhysicalShop;

/**
 * Class PhysicalShopMapper
 * @package Piggy\Api\Mappers
 */
class PhysicalShopMapper
{
    /**
     * @param $response
     * @return PhysicalShop
     */
    public function map($response): PhysicalShop
    {
        $physicalShop = new PhysicalShop();

        $physicalShop->setId($response->id);
        $physicalShop->setName($response->name);

        return $physicalShop;
    }
}