<?php

namespace Piggy\Api\Mappers;

use Piggy\Api\Models\Webshop;

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
        $webshop = new Webshop($data->id, $data->name);
        return $webshop;
    }
}