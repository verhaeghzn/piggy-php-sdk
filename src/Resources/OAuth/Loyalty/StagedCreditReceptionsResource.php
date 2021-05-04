<?php

namespace Piggy\Api\Resources\OAuth\Loyalty;

use Piggy\Api\Exceptions\RequestException;
use Piggy\Api\Mappers\Loyalty\StagedCreditReceptionMapper;
use Piggy\Api\Models\Loyalty\StagedCreditReception;
use Piggy\Api\Models\Shops\Shop;
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
     * @param \Piggy\Api\Models\Shops\Shop $shop
     * @param int $credits
     * @param float|null $purchaseAmount
     * @return \Piggy\Api\Models\Loyalty\StagedCreditReception
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Piggy\Api\Exceptions\PiggyRequestException
     */
    public function create(Shop $shop, int $credits, float $purchaseAmount = null): StagedCreditReception
    {
        $response = $this->client->post($this->resourceUri, [
            "shop_id" => $shop->getId(),
            "credits" => $credits,
            "purchase_amount" => $purchaseAmount,
        ]);

        $mapper = new StagedCreditReceptionMapper();

        return $mapper->map($response->getData());
    }

    /**
     * @param StagedCreditReception $stagedCreditReception
     * @param string $email
     * @param null $locale
     * @return StagedCreditReception
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Piggy\Api\Exceptions\PiggyRequestException
     */
    public function send(StagedCreditReception $stagedCreditReception, string $email, $locale = null): StagedCreditReception
    {
        $response = $this->client->post("{$this->resourceUri}/{$stagedCreditReception->getId()}/send", [
            "email" => $email,
            "locale" => $locale
        ]);

        $mapper = new StagedCreditReceptionMapper();

        return $mapper->map($response->getData());
    }
}
