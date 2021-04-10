<?php

namespace Piggy\Api\Resources\OAuth;

use Piggy\Api\Exceptions\BadResponseException;
use Piggy\Api\Exceptions\RequestException;
use Piggy\Api\Mappers\WebshopMapper;
use Piggy\Api\Mappers\WebshopsMapper;
use Piggy\Api\Models\Webshop;
use Piggy\Api\Resources\BaseResource;

/**
 * Class WebshopsResource
 * @package Piggy\Api\Resources\OAuth
 */
class WebshopsResource extends BaseResource
{
    /**
     * @var string
     */
    protected $resourceUri = "/api/v1/oauth/clients/shops/web";

    /**
     * @return array
     * @throws BadResponseException
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
     * @throws BadResponseException
     * @throws RequestException
     */
    public function get(int $id): Webshop
    {
        $response = $this->client->get("{$this->resourceUri}/{$id}", []);

        $mapper = new WebshopMapper();

        return $mapper->map($response->getData());
    }
}