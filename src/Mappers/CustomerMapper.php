<?php

namespace Piggy\Api\Mappers;

use Piggy\Api\Model\Customer;

/**
 * Class CustomerMapper
 * @package Piggy\Api\Mappers
 */
class CustomerMapper
{
    /**
     * @param $response
     * @return Customer
     */
    public function mapFromResponse($response): Customer
    {
        $customer = new Customer();

        $customer->setId($response->id);
        $customer->setEmail($response->email);
        $customer->setFirstName($response->first_name ?? null);
        $customer->setLastName($response->last_name ?? null);

        return $customer;
    }
}