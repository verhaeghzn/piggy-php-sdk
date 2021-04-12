<?php

namespace Piggy\Api\Resources\OAuth\Giftcards;

use Piggy\Api\Enum\GiftcardType;
use Piggy\Api\Exceptions\RequestException;
use Piggy\Api\Mappers\Giftcards\GiftcardMapper;
use Piggy\Api\Models\Giftcards\Giftcard;
use Piggy\Api\Models\Giftcards\GiftcardProgram;
use Piggy\Api\Models\Shops\Shop;
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
     * @param Shop $shop
     * @param string $hash
     * @return Giftcard
     * @throws RequestException
     */
    public function findOneBy(Shop $shop, string $hash): Giftcard
    {
        $body = [
            "shop_id" => $shop->getId(),
            "hash" => $hash,
        ];

        $response = $this->client->get("{$this->resourceUri}/find-one-by", $body);

        $mapper = new GiftcardMapper();

        return $mapper->map($response->getData());
    }

    /**
     * @param Shop $shop
     * @param GiftcardProgram $giftcardProgram
     * @param int $type
     * @return Giftcard
     * @throws RequestException
     */
    public function create(Shop $shop, GiftcardProgram $giftcardProgram, int $type): Giftcard
    {
        $body = [
            "shop_id" => $shop->getId(),
            "giftcard_program_id" => $giftcardProgram->getId(),
            "type" => $type
        ];

        $response = $this->client->post($this->resourceUri, $body);

        $mapper = new GiftcardMapper();

        return $mapper->map($response->getData());
    }
}
