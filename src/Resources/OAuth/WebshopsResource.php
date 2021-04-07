<?php

namespace Piggy\Api\Resources\OAuth;

use Piggy\Api\Exceptions\RequestException;
use Piggy\Api\Mappers\WebshopMapper;
use Piggy\Api\Mappers\WebshopsMapper;
use Piggy\Api\Model\Webshop;
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
     * @throws RequestException
     */
    public function all()
    {
        $response = $this->client->request("GET", $this->resourceUri, []);

        $mapper = new WebshopsMapper();

        return $mapper->mapFromResponse($this->getDataFromResponse($response));
    }

    /**
     * @param int $id
     * @return Webshop
     * @throws RequestException
     */
    public function get(int $id)
    {
        $response = $this->client->request('GET', $this->resourceUri . "/" . $id, []);

        $mapper = new WebshopMapper();

        return $mapper->mapFromResponse($this->getDataFromResponse($response));
    }
}