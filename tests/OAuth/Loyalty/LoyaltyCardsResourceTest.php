<?php

namespace Tests\OAuth\Loyalty;

use Exception;
use Piggy\Api\Enum\CardStatus;
use Piggy\Api\Enum\CardType;
use Piggy\Api\Exceptions\RequestException;
use Piggy\Api\Models\Loyalty\CreditReception;
use Piggy\Api\Models\Loyalty\LoyaltyCard;
use Piggy\Api\Models\Loyalty\Member;
use Tests\OAuthTestCase;

/**
 * Class LoyaltyCardsResourceTest
 * @package Tests\OAuth\Loyalty
 */
class LoyaltyCardsResourceTest extends OAuthTestCase
{
    /**
     * @test
     * @throws RequestException
     * @throws Exception
     */
    public function it_returns_a_loyalty_card()
    {
        $member = new Member(1, "tests@piggy.nl");

        $loyaltyCard = new LoyaltyCard(1, "1234", CardType::PHYSICAL, CardStatus::ACTIVE, $member);

        $this->addExpectedResponse([
            "id" => $loyaltyCard->getId(),
            "hash" => $loyaltyCard->getHash(),
            "type" => CardType::from($loyaltyCard->getType())->getKey(),
            "status" => CardStatus::from($loyaltyCard->getType())->getKey(),
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
     * @throws RequestException
     */
    public function it_returns_a_loyalty_card_after_linking()
    {
        $member = new Member(1, "tests@piggy.nl");

        $loyaltyCard = new LoyaltyCard(1, "1234", CardType::PHYSICAL, CardStatus::ACTIVE, $member);

        $this->addExpectedResponse([
            "id" => $loyaltyCard->getId(),
            "hash" => $loyaltyCard->getHash(),
            "type" => CardType::from($loyaltyCard->getType())->getKey(),
            "status" => CardStatus::from($loyaltyCard->getType())->getKey(),
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
