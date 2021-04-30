<?php

namespace Piggy\Api\Tests\OAuth\Giftcards;

use Piggy\Api\Enum\GiftcardType;
use Piggy\Api\Exceptions\PiggyRequestException;
use Piggy\Api\Exceptions\RequestException;
use Piggy\Api\Models\Giftcards\Giftcard;
use Piggy\Api\Models\Giftcards\GiftcardProgram;
use Piggy\Api\OAuthClient;
use Piggy\Api\Tests\OAuthTestCase;

/**
 * Class GiftcardsResourceTest
 * @package Piggy\Api\Tests\OAuth\Shops
 */
class GiftcardsResourceTest extends OAuthTestCase
{
    /**
     * @test
     * @throws RequestException
     */
    public function it_finds_a_giftcard_by_hash()
    {
        $shop = $this->createShop();
        $giftcardProgram = new GiftcardProgram(1, "program for test");
        $giftcard = new Giftcard(1, "giftcard123", GiftcardType::DIGITAL, true, true, $giftcardProgram);

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

        $data = $this->mockedClient->giftcards->findOneBy($shop, "giftcard123");

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
     * @throws RequestException
     */
    public function it_returns_giftcard_after_creation()
    {
        $shop = $this->createShop();
        $giftcardProgram = new GiftcardProgram(1, "program for test");
        $giftcard = new Giftcard(1, "giftcard123", GiftcardType::DIGITAL, true, true, $giftcardProgram);

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

        $data = $this->mockedClient->giftcards->create($shop, $giftcardProgram, GiftcardType::DIGITAL);

        $this->assertEquals($data->getId(), $giftcard->getId());
        $this->assertEquals($data->getHash(), $giftcard->getHash());
        $this->assertEquals($data->getType(), $giftcard->getType());
        $this->assertEquals($data->isActive(), $giftcard->isActive());
        $this->assertEquals($data->isUpgradeable(), $giftcard->isUpgradeable());
        $this->assertEquals($data->getGiftcardProgram()->getId(), $giftcard->getGiftcardProgram()->getId());
        $this->assertEquals($data->getGiftcardProgram()->getName(), $giftcard->getGiftcardProgram()->getName());
    }
}
