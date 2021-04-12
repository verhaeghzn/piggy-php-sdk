<?php

namespace Piggy\Api\Mappers\Marketing;

use Piggy\Api\Mappers\BaseMapper;
use Piggy\Api\Models\Marketing\MarketingProgram;

/**
 * Class MarketingRecipientMapper
 * @package Piggy\Api\Mappers\Marketing
 */
class MarketingProgramMapper extends BaseMapper
{
    /**
     * @param object $data
     * @return MarketingProgram
     */
    public function map(object $data): MarketingProgram
    {
        $marketingProgram = new MarketingProgram(
            $data->id,
            $data->name
        );

        return $marketingProgram;
    }
}