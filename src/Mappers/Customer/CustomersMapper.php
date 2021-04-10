<?php

namespace Piggy\Api\Mappers\Customer;

/**
 * Class CustomersMapper
 * @package Piggy\Api\Mappers\Customer
 */
class CustomersMapper
{
    /**
     * @param $data
     * @return array
     */
    public function map($data): array
    {
        $customerMapper = new CustomerMapper();

        $customers = [];
        foreach ($data as $item) {
            $customers[] = $customerMapper->map($item);
        }

        return $customers;
    }
}
