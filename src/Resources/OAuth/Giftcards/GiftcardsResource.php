<?php

namespace Piggy\Api\Resources\OAuth\Giftcards;

use Piggy\Api\Exceptions\RequestException;
use Piggy\Api\Mappers\Giftcards\GiftcardMapper;
use Piggy\Api\Models\Giftcards\Giftcard;
use Piggy\Api\Resources\BaseResource;

/**
 * Class GiftcardsResource
 * @package Piggy\Api\Resources\OAuth\Giftcards
 */
class GiftcardsResource extends BaseResource
{
    /**
     * @var string
     */
    protected $resourceUri = "/api/v2/oauth/clients/giftcards";

    /**
     * @param int $giftcardProgramId
     * @param int $type
     * @param int $shopId
     *
     * @return Giftcard
     * @throws RequestException
     */
    public function create(int $giftcardProgramId, int $type, int $shopId): Giftcard
    {
        $response = $this->client->post($this->resourceUri, [
            "giftcard_program_id" => $giftcardProgramId,
            "type" => $type,
            "shop_id" => $shopId,
        ]);

        $mapper = new GiftcardMapper();

        return $mapper->map($response->getData());
    }

    /**
     * @param string $hash
     * @param int $shopId
     *
     * @return Giftcard
     * @throws RequestException
     */
    public function findOneBy(string $hash, int $shopId): Giftcard
    {
        $response = $this->client->get("{$this->resourceUri}/find-one-by", [
            "hash" => $hash,
            "shop_id" => $shopId,
        ]);

        $mapper = new GiftcardMapper();

        return $mapper->map($response->getData());
    }
}
