<?php

namespace Piggy\Api\Mappers\Shops;

use Exception;
use Piggy\Api\Enum\ShopType;
use Piggy\Api\Models\Shops\PhysicalShop;
use Piggy\Api\Models\Shops\Webshop;

/**
 * Class ShopMapper
 * @package Piggy\Api\Mappers\Shops
 */
class ShopMapper
{
    /**
     * @param object $data
     * @return PhysicalShop|Webshop
     * @throws Exception
     */
    public function map(object $data)
    {
        $physicalShopMapper = new PhysicalShopMapper();
        $webShopMapper = new WebshopMapper();

        $shop = null;

        if ($data->type == ShopType::PHYSICAL) {
            $shop = $physicalShopMapper->map($data);
        }

        if ($data->type == ShopType::WEB) {
            $shops[] = $webShopMapper->map($data);
        }

        if ($shop === null) {
            throw new Exception("Shop could not be mapped. No shop type given");
        }

        return $shop;
    }
}
