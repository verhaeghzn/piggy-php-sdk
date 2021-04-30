<?php

namespace Piggy\Api\Resources\Register\Registers;

use Piggy\Api\Exceptions\RequestException;
use Piggy\Api\Mappers\Registers\RegisterMapper;
use Piggy\Api\Models\Registers\Register;
use Piggy\Api\Resources\BaseResource;

/**
 * Class RegisterResource
 * @package Piggy\Api\Resources\Register\Registers
 */
class RegisterResource extends BaseResource
{
    /**
     * @var string
     */
    protected $resourceUri = "/api/v1/register";

    /**
     * @return Register
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Piggy\Api\Exceptions\PiggyRequestException
     */
    public function get(): Register
    {
        $response = $this->client->get($this->resourceUri);

        $mapper = new RegisterMapper();

        return $mapper->map($response->getData());
    }

}
