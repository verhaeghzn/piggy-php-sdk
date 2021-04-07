<?php

namespace Piggy\Api\Mappers;

use Piggy\Api\Model\Webshop;

/**
 * Class WebshopMapper
 * @package Piggy\Api\Mappers
 */
class WebshopMapper
{
    /**
     * @param $response
     * @return Webshop
     */
    public function mapFromResponse($response): Webshop
    {
        $webshop = new Webshop();

        $webshop->setId($response->id);
        $webshop->setName($response->name);

        return $webshop;
    }
}