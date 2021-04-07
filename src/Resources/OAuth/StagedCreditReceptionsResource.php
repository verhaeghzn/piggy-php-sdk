<?php

namespace Piggy\Api\Resources\OAuth;

use Piggy\Api\Exceptions\RequestException;
use Piggy\Api\Mappers\StagedCreditReceptionMapper;
use Piggy\Api\Model\StagedCreditReception;
use Piggy\Api\Resources\BaseResource;

/**
 * Class StagedCreditReceptionsResource
 * @package Piggy\Api\Resources\OAuth
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
    public function get(int $id)
    {
        $response = $this->client->request('GET', $this->resourceUri . "/" . $id, []);

        $mapper = new StagedCreditReceptionMapper();

        return $mapper->mapFromResponse($this->getDataFromResponse($response));
    }

    /**
     * @param $hash
     * @param $email
     * @param null $locale
     * @return StagedCreditReception
     * @throws RequestException
     */
    public function send($hash, $email, $locale = null)
    {
        $body = [
            "hash" => $hash,
            "email" => $email,
            "locale" => $locale
        ];

        $response = $this->client->request('POST', $this->resourceUri . '/send', $body);

        $mapper = new StagedCreditReceptionMapper();

        return $mapper->mapFromResponse($this->getDataFromResponse($response));
    }

    /**
     * @param int $shopId
     * @param int $purchaseAmount
     * @param int|null $credits
     * @return StagedCreditReception
     * @throws RequestException
     */
    public function create(int $shopId, int $purchaseAmount, int $credits = null)
    {
        $body = [
            "shop_id" => $shopId,
            "purchase_amount" => $purchaseAmount,
            "credits" => $credits,
        ];

        $response = $this->client->request('POST', $this->resourceUri, $body);

        $mapper = new StagedCreditReceptionMapper();

        return $mapper->mapFromResponse($this->getDataFromResponse($response));
    }
}