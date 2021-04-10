<?php

namespace Piggy\Api\Mappers;

/**
 * Class CustomersMapper
 * @package Piggy\Api\Mappers
 */
class CustomersMapper
{
    /**
     * @param $response
     * @return array
     */
    public function map($response): array
    {
        $customers = [];
        $customerMapper = new CustomerMapper();

        foreach ($response as $item) {
            $customers[] = $customerMapper->map($item);
        }

        return $customers;
    }
}
