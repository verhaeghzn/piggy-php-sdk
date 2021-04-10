<?php

namespace Piggy\Api\Mappers;

use Piggy\Api\Models\Customer;
use stdClass;

/**
 * Class CustomerMapper
 * @package Piggy\Api\Mappers
 */
class CustomerMapper
{
    /**
     * @param stdClass $data
     * @return Customer
     */
    public function map(stdClass $data): Customer
    {
        $customer = new Customer();

        $customer->setId($data->id);
        $customer->setEmail($data->email);
        $customer->setFirstName($data->first_name ?? null);
        $customer->setLastName($data->last_name ?? null);

        return $customer;
    }
}