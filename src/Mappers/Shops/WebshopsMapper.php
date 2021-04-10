<?php

namespace Piggy\Api\Mappers\Shops;

/**
 * Class WebshopsMapper
 * @package Piggy\Api\Mappers\Shops
 */
class WebshopsMapper
{
    /**
     * @param $data
     * @return array
     */
    public function map($data): array
    {
        $webshopMapper = new WebshopMapper();

        $webshops = [];
        foreach ($data as $item) {
            $webshops[] = $webshopMapper->map($item);
        }

        return $webshops;
    }
}
