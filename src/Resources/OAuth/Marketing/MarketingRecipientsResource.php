<?php

namespace Piggy\Api\Resources\OAuth\Marketing;

use Piggy\Api\Exceptions\RequestException;
use Piggy\Api\Mappers\Marketing\MarketingRecipientMapper;
use Piggy\Api\Models\Marketing\MarketingProgram;
use Piggy\Api\Models\Marketing\MarketingRecipient;
use Piggy\Api\Resources\BaseResource;

class MarketingRecipientsResource extends BaseResource
{
    /**
     * @var string
     */
    protected $resourceUri = "/api/v2/oauth/clients/marketing-recipients";

    /**
     * @param MarketingProgram $marketingProgram
     * @param string $email
     * @return MarketingRecipient
     * @throws RequestException
     */
    public function find(MarketingProgram $marketingProgram, string $email)
    {
        $response = $this->client->get($this->resourceUri, [
            "marketing_program_id" => $marketingProgram->getId(),
            "email" => $email,
        ]);

        $mapper = new MarketingRecipientMapper();

        return $mapper->map($response->getData());
    }


}