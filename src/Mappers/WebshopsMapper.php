<?php

namespace Piggy\Api\Mappers;

/**
 * Class WebshopsMapper
 * @package Piggy\Api\Mappers
 */
class WebshopsMapper
{
    /**
     * @param $response
     * @return array
     */
    public function map($response): array
    {
        $webshops = [];
        $webshopMapper = new WebshopMapper();

        foreach ($response as $item) {
            $webshops[] = $webshopMapper->map($item);
        }

        return $webshops;
    }
}
