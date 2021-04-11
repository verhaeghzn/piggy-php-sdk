<?php

namespace Piggy\Api\Mappers\Shops;

use Piggy\Api\Enum\ShopType;

/**
 * Class ShopsMapper
 * @package Piggy\Api\Mappers\Shops
 */
class ShopsMapper
{
    /**
     * @param $data
     * @return array
     */
    public function map($data): array
    {
        $physicalShopMapper = new PhysicalShopMapper();
        $webShopMapper = new WebshopMapper();

        $shops = [];
        foreach ($data as $item) {
            if ($item->type == ShopType::PHYSICAL) {
                $shops[] = $physicalShopMapper->map($item);
            }

            if ($item->type == ShopType::WEB) {
                $shops[] = $webShopMapper->map($item);
            }
        }

        return $shops;
    }
}
