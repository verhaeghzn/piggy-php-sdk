<?php

namespace Piggy\Api\Mappers\Customer;

use Piggy\Api\Models\Customer\Customer;

/**
 * Class CustomerMapper
 * @package Piggy\Api\Mappers\Customer
 */
class CustomerMapper
{
    /**
     * @param object $data
     * @return Customer
     */
    public function map(object $data): Customer
    {
        $customer = new Customer();

        $customer->setId($data->id);
        $customer->setEmail($data->email);
        $customer->setFirstName($data->first_name ?? null);
        $customer->setLastName($data->last_name ?? null);

        return $customer;
    }
}
