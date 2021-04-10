<?php

namespace Piggy\Api\Mappers\Loyalty;

/**
 * Class MembersMapper
 * @package Piggy\Api\Mappers\Loyalty
 */
class MembersMapper
{
    /**
     * @param $data
     * @return array
     */
    public function map($data): array
    {
        $memberMapper = new MemberMapper();

        $members = [];
        foreach ($data as $item) {
            $members[] = $memberMapper->map($item);
        }

        return $members;
    }
}
