<?php

namespace Piggy\Api\Resources\OAuth\Marketing;

use Piggy\Api\Mappers\Marketing\MarketingRecipientMapper;
use Piggy\Api\Models\Marketing\MarketingRecipient;
use Piggy\Api\Resources\BaseResource;

/**
 * Class MarketingRecipientsResource
 * @package Piggy\Api\Resources\OAuth\Marketing
 */
class MarketingRecipientsResource extends BaseResource
{
    /**
     * @var string
     */
    protected $resourceUri = "/api/v2/oauth/clients/marketing-recipients";

    /**
     * @param int $marketingProgramId
     * @param string $email
     *
     * @return MarketingRecipient
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Piggy\Api\Exceptions\PiggyRequestException
     */
    public function get(int $marketingProgramId, string $email): MarketingRecipient
    {
        $response = $this->client->get($this->resourceUri, [
            "marketing_program_id" => $marketingProgramId,
            "email" => $email,
        ]);

        $mapper = new MarketingRecipientMapper();

        return $mapper->map($response->getData());
    }

    /**
     * @param int $marketingProgramId
     * @param string $email
     *
     * @return MarketingRecipient
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Piggy\Api\Exceptions\PiggyRequestException
     */
    public function create(int $marketingProgramId, string $email): MarketingRecipient
    {
        $response = $this->client->post($this->resourceUri, [
            "marketing_program_id" => $marketingProgramId,
            "email" => $email,
        ]);

        $mapper = new MarketingRecipientMapper();

        return $mapper->map($response->getData());
    }

    /**
     * @param MarketingRecipient $marketingRecipient
     *
     * @return MarketingRecipient
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Piggy\Api\Exceptions\PiggyRequestException
     */
    public function update(MarketingRecipient $marketingRecipient): MarketingRecipient
    {
        $response = $this->client->put("{$this->resourceUri}/{$marketingRecipient->getId()}", []);

        $mapper = new MarketingRecipientMapper();

        return $mapper->map($response->getData());
    }

}