<?php

namespace Piggy\Api\Resources\Customer;

use Exception;
use Piggy\Api\Exceptions\RequestException;
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
     * @throws RequestException
     */
    public function show(): Customer
    {
        $response = $this->client->get($this->resourceUri);

        $mapper = new CustomerMapper();

        return $mapper->map($response->getData());
    }
}
