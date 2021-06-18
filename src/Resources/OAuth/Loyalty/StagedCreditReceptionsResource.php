<?php

namespace Piggy\Api\Resources\OAuth\Loyalty;

use Piggy\Api\Mappers\Loyalty\StagedCreditReceptionMapper;
use Piggy\Api\Models\Loyalty\StagedCreditReception;
use Piggy\Api\Resources\BaseResource;

/**
 * Class StagedCreditReceptionsResource
 * @package Piggy\Api\Resources\OAuth\Loyalty
 */
class StagedCreditReceptionsResource extends BaseResource
{
    /**
     * @var string
     */
    protected $resourceUri = "/api/v2/oauth/clients/staged-credit-receptions";

    /**
     * @param int $id
     * @return StagedCreditReception
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Piggy\Api\Exceptions\PiggyRequestException
     */
    public function get(int $id): StagedCreditReception
    {
        $response = $this->client->get("{$this->resourceUri}/{$id}");

        $mapper = new StagedCreditReceptionMapper();

        return $mapper->map($response->getData());
    }

    /**
     * @param int $shopId
     * @param int $credits
     * @param float|null $purchaseAmount
     *
     * @return StagedCreditReception
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Piggy\Api\Exceptions\PiggyRequestException
     */
    public function create(int $shopId, int $credits, float $purchaseAmount = null): StagedCreditReception
    {
        $response = $this->client->post($this->resourceUri, [
            "shop_id" => $shopId,
            "credits" => $credits,
            "purchase_amount" => $purchaseAmount,
        ]);

        $mapper = new StagedCreditReceptionMapper();

        return $mapper->map($response->getData());
    }

    /**
     * @param int $stagedCreditReceptionId
     * @param string $email
     * @param null $locale
     *
     * @return \stdClass
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Piggy\Api\Exceptions\PiggyRequestException
     */
    public function send(int $stagedCreditReceptionId, string $email, $locale = null)
    {
        $response = $this->client->post("{$this->resourceUri}/{$stagedCreditReceptionId}/send", [
            "email" => $email,
            "locale" => $locale
        ]);

        return $response->getData();
    }
}
