<?php

namespace Piggy\Api\Mappers\Shops;

use Piggy\Api\Models\Shops\Webshop;

/**
 * Class WebshopMapper
 * @package Piggy\Api\Mappers
 */
class WebshopMapper
{
    /**
     * @param $data
     * @return Webshop
     */
    public function map($data): Webshop
    {
        $webshop = new Webshop(
            $data->id,
            $data->name
        );

        return $webshop;
    }
}
