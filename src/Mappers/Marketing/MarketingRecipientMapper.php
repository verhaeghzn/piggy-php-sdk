<?php

namespace Piggy\Api\Mappers\Marketing;

use Piggy\Api\Mappers\BaseMapper;
use Piggy\Api\Models\Marketing\MarketingRecipient;

/**
 * Class MarketingRecipientMapper
 * @package Piggy\Api\Mappers\Marketing
 */
class MarketingRecipientMapper extends BaseMapper
{
    /**
     * @param object $data
     * @return MarketingRecipient
     */
    public function map(object $data): MarketingRecipient
    {
        $marketingRecipient = new MarketingRecipient(
            $data->id,
            $data->email,
            $data->is_subscribed,
            $this->parseDate($data->created_at)
        );

        return $marketingRecipient;
    }
}