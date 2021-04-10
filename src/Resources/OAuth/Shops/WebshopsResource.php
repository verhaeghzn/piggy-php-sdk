<?php

namespace Piggy\Api\Resources\OAuth\Shops;

use Piggy\Api\Exceptions\RequestException;
use Piggy\Api\Mappers\Shops\WebshopMapper;
use Piggy\Api\Mappers\Shops\WebshopsMapper;
use Piggy\Api\Models\Shops\Webshop;
use Piggy\Api\Resources\BaseResource;

/**
 * Class WebshopsResource
 * @package Piggy\Api\Resources\OAuth\Shops
 */
class WebshopsResource extends BaseResource
{
    /**
     * @var string
     */
    protected $resourceUri = "/api/v1/oauth/clients/shops/web";

    /**
     * @return array
     * @throws RequestException
     */
    public function all(): array
    {
        $response = $this->client->get($this->resourceUri, []);

        $mapper = new WebshopsMapper();

        return $mapper->map($response->getData());
    }

    /**
     * @param int $id
     * @return Webshop
     * @throws RequestException
     */
    public function get(int $id): Webshop
    {
        $response = $this->client->get("{$this->resourceUri}/{$id}", []);

        $mapper = new WebshopMapper();

        return $mapper->map($response->getData());
    }
}
