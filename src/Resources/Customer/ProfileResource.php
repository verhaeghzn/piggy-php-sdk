<?php

namespace Piggy\Api\Resources\Customer;

use Piggy\Api\Mappers\Customer\CustomerMapper;
use Piggy\Api\Models\Customer\Customer;
use Piggy\Api\Resources\BaseResource;

/**
 * Class ProfileResource
 * @package Piggy\Api\Resources\Customer
 */
class ProfileResource extends BaseResource
{
    /**
     * @var string
     */
    protected $resourceUri = "/api/v1/oauth/customer/profile";

    /**
     * @return Customer
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Piggy\Api\Exceptions\PiggyRequestException
     */
    public function show(): Customer
    {
        $response = $this->client->get($this->resourceUri);

        $mapper = new CustomerMapper();

        return $mapper->map($response->getData());
    }
}
