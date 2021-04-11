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
     * @throws RequestException
     */
    public function get(int $id): StagedCreditReception
    {
        $response = $this->client->get("{$this->resourceUri}/{$id}");

        $mapper = new StagedCreditReceptionMapper();

        return $mapper->map($response->getData());
    }

    /**
     * @param Shop $shop
     * @param float $purchaseAmount
     * @param int|null $credits
     * @return StagedCreditReception
     * @throws RequestException
     */
    public function create(Shop $shop, float $purchaseAmount, int $credits = null): StagedCreditReception
    {
        $response = $this->client->post($this->resourceUri, [
            "shop_id" => $shop->getId(),
            "purchase_amount" => $purchaseAmount,
            "credits" => $credits,
        ]);

        $mapper = new StagedCreditReceptionMapper();

        return $mapper->map($response->getData());
    }

    /**
     * @param string $hash
     * @param string $email
     * @param null $locale
     * @return StagedCreditReception
     * @throws RequestException
     */
    public function send(string $hash, string $email, $locale = null): StagedCreditReception
    {
        $response = $this->client->post("{$this->resourceUri}/send", [
            "hash" => $hash,
            "email" => $email,
            "locale" => $locale
        ]);

        $mapper = new StagedCreditReceptionMapper();

        return $mapper->map($response->getData());
    }
}
