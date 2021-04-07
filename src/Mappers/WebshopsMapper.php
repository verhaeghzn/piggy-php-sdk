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
    public function mapFromResponse($response): array
    {
        $webshops = [];
        $webshopMapper = new WebshopMapper();

        foreach ($response as $item) {
            $webshops[] = $webshopMapper->mapFromResponse($item);
        }

        return $webshops;
    }
}
