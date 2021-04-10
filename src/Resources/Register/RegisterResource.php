<?php

namespace Piggy\Api\Resources\Register;

use Piggy\Api\Exceptions\RequestException;
use Piggy\Api\Mappers\Registers\RegisterMapper;
use Piggy\Api\Models\Registers\Register;
use Piggy\Api\Resources\BaseResource;

/**
 * Class RegisterResource
 * @package Piggy\Api\Resources\Register
 */
class RegisterResource extends BaseResource
{
    /**
     * @var string
     */
    protected $resourceUri = "/api/v1/register";

    /**
     * @return Register
     * @throws RequestException
     */
    public function get(): Register
    {
        $response = $this->client->get($this->resourceUri, []);

        $mapper = new RegisterMapper();

        return $mapper->map($response->getData());
    }

}
