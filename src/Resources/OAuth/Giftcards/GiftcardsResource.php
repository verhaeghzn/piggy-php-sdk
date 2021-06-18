<?php

namespace Piggy\Api\Resources\OAuth\Giftcards;

use Piggy\Api\Mappers\Giftcards\GiftcardMapper;
use Piggy\Api\Models\Giftcards\Giftcard;
use Piggy\Api\Resources\BaseResource;

/**
 * Class GiftcardsResource
 * @package Piggy\Api\Resources\OAuth\Loyalty
 */
class GiftcardsResource extends BaseResource
{
    /**
     * @var string
     */
    protected $resourceUri = "/api/v2/oauth/clients/giftcards";

    /**
     * @param int $shopId
     * @param string $hash
     *
     * @return Giftcard
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Piggy\Api\Exceptions\PiggyRequestException
     */
    public function findOneBy(int $shopId, string $hash): Giftcard
    {
        $response = $this->client->get("{$this->resourceUri}/find-one-by", [
            "shop_id" => $shopId,
            "hash" => $hash,
        ]);

        $mapper = new GiftcardMapper();

        return $mapper->map($response->getData());
    }

    /**
     * @param int $shopId
     * @param int $giftcardProgramId
     * @param int $type
     *
     * @return Giftcard
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Piggy\Api\Exceptions\PiggyRequestException
     */
    public function create(int $shopId, int $giftcardProgramId, int $type): Giftcard
    {
        $response = $this->client->post($this->resourceUri, [
            "shop_id" => $shopId,
            "giftcard_program_id" => $giftcardProgramId,
            "type" => $type
        ]);

        $mapper = new GiftcardMapper();

        return $mapper->map($response->getData());
    }
}
