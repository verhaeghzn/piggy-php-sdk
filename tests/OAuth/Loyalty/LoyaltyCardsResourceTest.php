<?php

namespace Piggy\Api\Tests\OAuth\Loyalty;

use GuzzleHttp\Exception\GuzzleException;
use Piggy\Api\Enum\CardStatus;
use Piggy\Api\Enum\CardType;
use Piggy\Api\Exceptions\PiggyRequestException;
use Piggy\Api\Models\Loyalty\LoyaltyCard;
use Piggy\Api\Tests\OAuthTestCase;

/**
 * Class LoyaltyCardsResourceTest
 * @package Piggy\Api\Tests\OAuth\Loyalty
 */
class LoyaltyCardsResourceTest extends OAuthTestCase
{
    /**
     * @test
     * @throws GuzzleException
     * @throws PiggyRequestException
     */
    public function it_returns_a_loyalty_card()
    {
        $member = $this->createMember();
        $shop = $this->createShop();
        $loyaltyCard = new LoyaltyCard(1, "1234", CardType::PHYSICAL, CardStatus::ACTIVE, $member);

        $this->addExpectedResponse([
            "id" => $loyaltyCard->getId(),
            "hash" => $loyaltyCard->getHash(),
            "type" => CardType::get($loyaltyCard->getType())->getName(),
            "status" => CardStatus::get($loyaltyCard->getStatus())->getName(),
            "member" => [
                "id" => $member->getId(),
                "email" => $member->getEmail()
            ],
        ]);

        $data = $this->mockedClient->loyaltyCards->findOneBy(1, "1234");

        $this->assertEquals($data->getId(), $loyaltyCard->getId());
        $this->assertEquals($data->getHash(), $loyaltyCard->getHash());
        $this->assertEquals($data->getStatus(), $loyaltyCard->getStatus());
        $this->assertEquals($data->getType(), $loyaltyCard->getType());

        $this->assertEquals($data->getMember()->getId(), $loyaltyCard->getMember()->getId());
        $this->assertEquals($data->getMember()->getEmail(), $loyaltyCard->getMember()->getEmail());
    }

    /**
     * @test
     * @throws GuzzleException
     * @throws PiggyRequestException
     */
    public function it_returns_a_loyalty_card_after_linking()
    {
        $member = $this->createMember();
        $loyaltyCard = new LoyaltyCard(1, "1234", CardType::PHYSICAL, CardStatus::ACTIVE, $member);

        $this->addExpectedResponse([
            "id" => $loyaltyCard->getId(),
            "hash" => $loyaltyCard->getHash(),
            "type" => CardType::get($loyaltyCard->getType())->getName(),
            "status" => CardStatus::get($loyaltyCard->getStatus())->getName(),
            "member" => [
                "id" => $member->getId(),
                "email" => $member->getEmail()
            ],
        ]);

        $data = $this->mockedClient->loyaltyCards->link(1, $member, $loyaltyCard);

        $this->assertEquals($data->getId(), $loyaltyCard->getId());
        $this->assertEquals($data->getHash(), $loyaltyCard->getHash());
        $this->assertEquals($data->getStatus(), $loyaltyCard->getStatus());
        $this->assertEquals($data->getType(), $loyaltyCard->getType());

        $this->assertEquals($data->getMember()->getId(), $loyaltyCard->getMember()->getId());
        $this->assertEquals($data->getMember()->getEmail(), $loyaltyCard->getMember()->getEmail());
    }
}
