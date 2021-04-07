<?php

namespace Piggy\Api\Resources\Customer;

use Piggy\Api\Exceptions\RequestException;
use Piggy\Api\Mappers\CustomerMapper;
use Piggy\Api\Model\Customer;
use Piggy\Api\Resources\BaseResource;

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
        $response = $this->client->request('GET', $this->resourceUri, []);

        $mapper = new CustomerMapper();

        return $mapper->mapFromResponse($this->getDataFromResponse($response));
    }
}