<?php

namespace Piggy\Api\Mappers;

use Piggy\Api\Model\Member;
use Piggy\Api\Model\PhysicalShop;

/**
 * Class PhysicalShopMapper
 * @package Piggy\Api\Mappers
 */
class PhysicalShopMapper
{
    /**
     * @param $response
     * @return Member
     */
    public function mapFromResponse($response): PhysicalShop
    {
        $physicalShop = new PhysicalShop();

        $physicalShop->setId($response->id);
        $physicalShop->setName($response->name);

        return $physicalShop;
    }
}