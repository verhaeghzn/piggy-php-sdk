<?php

namespace Piggy\Api\Tests\OAuth\Giftcards;

use GuzzleHttp\Exception\GuzzleException;
use Piggy\Api\Enum\GiftcardType;
use Piggy\Api\Exceptions\PiggyRequestException;
use Piggy\Api\Models\Giftcards\Giftcard;
use Piggy\Api\Models\Giftcards\GiftcardProgram;
use Piggy\Api\Tests\OAuthTestCase;

/**
 * Class GiftcardsResourceTest
 * @package Piggy\Api\Tests\OAuth\Giftcards
 */
class GiftcardsResourceTest extends OAuthTestCase
{
    /**
     * @test
     * @throws PiggyRequestException
     * @throws GuzzleException
     */
    public function it_finds_a_giftcard_by_hash()
    {
        $giftcardProgram = new GiftcardProgram(1, "program for test");
        $giftcard = new Giftcard(1, "giftcard123", GiftcardType::DIGITAL, true, true, $giftcardProgram, null);

        $this->addExpectedResponse([
            "id" => $giftcard->getId(),
            "hash" => $giftcard->getHash(),
            "type" => GiftcardType::get($giftcard->getType())->getName(),
            "active" => $giftcard->isActive(),
            "upgradeable" => $giftcard->isUpgradeable(),
            "expiration_date" => $giftcard->getExpirationDate(),
            "giftcard_program" => [
                "id" => $giftcardProgram->getId(),
                "name" => $giftcardProgram->getName()
            ]
        ]);

        $data = $this->mockedClient->giftcards->findOneBy(1, "giftcard123");

        $this->assertEquals($data->getId(), $giftcard->getId());
        $this->assertEquals($data->getHash(), $giftcard->getHash());
        $this->assertEquals($data->getType(), $giftcard->getType());
        $this->assertEquals($data->isActive(), $giftcard->isActive());
        $this->assertEquals($data->isUpgradeable(), $giftcard->isUpgradeable());
        $this->assertEquals($data->getGiftcardProgram()->getId(), $giftcard->getGiftcardProgram()->getId());
        $this->assertEquals($data->getGiftcardProgram()->getName(), $giftcard->getGiftcardProgram()->getName());
    }

    /**
     * @test
     * @throws PiggyRequestException
     * @throws GuzzleException
     */
    public function it_returns_giftcard_after_creation()
    {
        $giftcardProgram = new GiftcardProgram(2, "program for test");
        $giftcard = new Giftcard(1, "giftcard123", GiftcardType::DIGITAL, true, true, $giftcardProgram, null);

        $this->addExpectedResponse([
            "id" => $giftcard->getId(),
            "hash" => $giftcard->getHash(),
            "type" => GiftcardType::get($giftcard->getType())->getName(),
            "active" => $giftcard->isActive(),
            "upgradeable" => $giftcard->isUpgradeable(),
            "expiration_date" => $giftcard->getExpirationDate(),
            "giftcard_program" => [
                "id" => $giftcardProgram->getId(),
                "name" => $giftcardProgram->getName()
            ]
        ]);

        $data = $this->mockedClient->giftcards->create(1, 2, GiftcardType::DIGITAL);

        $this->assertEquals($data->getId(), $giftcard->getId());
        $this->assertEquals($data->getHash(), $giftcard->getHash());
        $this->assertEquals($data->getType(), $giftcard->getType());
        $this->assertEquals($data->isActive(), $giftcard->isActive());
        $this->assertEquals($data->isUpgradeable(), $giftcard->isUpgradeable());
        $this->assertEquals($data->getGiftcardProgram()->getId(), $giftcard->getGiftcardProgram()->getId());
        $this->assertEquals($data->getGiftcardProgram()->getName(), $giftcard->getGiftcardProgram()->getName());
    }
}
