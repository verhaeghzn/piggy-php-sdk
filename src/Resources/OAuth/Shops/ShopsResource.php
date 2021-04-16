<?php

namespace Piggy\Api\Resources\OAuth\Shops;

use Piggy\Api\Exceptions\RequestException;
use Piggy\Api\Mappers\Shops\ShopMapper;
use Piggy\Api\Mappers\Shops\ShopsMapper;
use Piggy\Api\Models\Shops\Shop;
use Piggy\Api\Resources\BaseResource;

/**
 * Class ShopsResource
 * @package Piggy\Api\Resources\OAuth\Shops
 */
class ShopsResource extends BaseResource
{
    /**
     * @var string
     */
    protected $resourceUri = "/api/v2/oauth/clients/shops";

    /**
     * @return array
     * @throws RequestException
     */
    public function all(): array
    {
        $response = $this->client->get($this->resourceUri, []);

        $mapper = new ShopsMapper();

        return $mapper->map($response->getData());
    }

    /**
     * @param int $id
     * @return Shop
     * @throws RequestException
     */
    public function get(int $id): Shop
    {
        $response = $this->client->get("{$this->resourceUri}/{$id}", []);

        $mapper = new ShopMapper();

        return $mapper->map($response->getData());
    }
}
