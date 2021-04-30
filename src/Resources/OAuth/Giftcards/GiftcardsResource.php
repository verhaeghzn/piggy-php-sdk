<?php

namespace Piggy\Api\Resources\OAuth\Giftcards;

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
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Piggy\Api\Exceptions\PiggyRequestException
     */
    public function findOneBy(Shop $shop, string $hash): Giftcard
    {
        $response = $this->client->get("{$this->resourceUri}/find-one-by", [
            "shop_id" => $shop->getId(),
            "hash" => $hash,
        ]);

        $mapper = new GiftcardMapper();

        return $mapper->map($response->getData());
    }

    /**
     * @param Shop $shop
     * @param GiftcardProgram $giftcardProgram
     * @param int $type
     * @return Giftcard
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Piggy\Api\Exceptions\PiggyRequestException
     */
    public function create(Shop $shop, GiftcardProgram $giftcardProgram, int $type): Giftcard
    {
        $response = $this->client->post($this->resourceUri, [
            "shop_id" => $shop->getId(),
            "giftcard_program_id" => $giftcardProgram->getId(),
            "type" => $type
        ]);

        $mapper = new GiftcardMapper();

        return $mapper->map($response->getData());
    }
}
