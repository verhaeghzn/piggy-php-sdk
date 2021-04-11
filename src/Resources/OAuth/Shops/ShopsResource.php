<?php

namespace Piggy\Api\Resources\OAuth\Shops;

use Piggy\Api\Exceptions\RequestException;
use Piggy\Api\Mappers\Shops\ShopsMapper;
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
     * @return array
     * @throws RequestException
     */
    public function get(int $id): array
    {
        $response = $this->client->get("{$this->resourceUri}/{$id}", []);

        $mapper = new ShopsMapper();

        return $mapper->map($response->getData());
    }
}
