<?php

namespace Piggy\Api\Mappers;

/**
 * Class MembersMapper
 * @package Piggy\Api\Mappers
 */
class MembersMapper
{
    /**
     * @param $response
     * @return array
     */
    public function map($response): array
    {
        $members = [];
        $memberMapper = new MemberMapper();

        foreach ($response as $item) {
            $members[] = $memberMapper->map($item);
        }

        return $members;
    }
}
