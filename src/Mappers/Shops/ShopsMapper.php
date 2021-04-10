<?php

namespace Piggy\Api\Mappers\Shops;

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
            if ($item->type == "physical") {
                $shops[] = $physicalShopMapper->map($item);
            }

            if ($item->type == "web") {
                $shops[] = $webShopMapper->map($item);
            }
        }

        return $shops;
    }
}
