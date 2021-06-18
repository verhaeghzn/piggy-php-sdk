<?php

namespace Piggy\Api\Resources\Register\Giftcards;

use Piggy\Api\Exceptions\RequestException;
use Piggy\Api\Mappers\Giftcards\GiftcardMapper;
use Piggy\Api\Models\Giftcards\Giftcard;
use Piggy\Api\Resources\BaseResource;

/**
 * Class GiftcardsResource
 * @package Piggy\Api\Resources\Register\Giftcards
 */
class GiftcardsResource extends BaseResource
{
    /**
     * @var string
     */
    protected $resourceUri = "/api/v1/register/giftcards";

    /**
     * @param int $giftcardProgramId
     * @param int $type
     *
     * @return Giftcard
     * @throws RequestException
     */
    public function create(int $giftcardProgramId, int $type): Giftcard
    {
        $response = $this->client->post($this->resourceUri, [
            "giftcard_program_id" => $giftcardProgramId,
            "type" => $type,
        ]);

        $mapper = new GiftcardMapper();

        return $mapper->map($response->getData());
    }

    /**
     * @param string $hash
     *
     * @return Giftcard
     * @throws RequestException
     */
    public function findOneBy(string $hash): Giftcard
    {
        $response = $this->client->get("{$this->resourceUri}/find-one-by", [
            "hash" => $hash,
        ]);

        $mapper = new GiftcardMapper();

        return $mapper->map($response->getData());
    }
}
