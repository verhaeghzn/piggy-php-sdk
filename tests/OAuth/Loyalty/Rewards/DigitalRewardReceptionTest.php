<?php

namespace Piggy\Api\Tests\OAuth\Loyalty\Rewards;

use Piggy\Api\Enum\CardStatus;
use Piggy\Api\Enum\CardType;
use Piggy\Api\Exceptions\RequestException;
use Piggy\Api\Models\Loyalty\LoyaltyCard;
use Piggy\Api\Models\Loyalty\RewardReceptions\DigitalRewardReception;
use Piggy\Api\Models\Loyalty\Rewards\DigitalReward;
use Piggy\Api\Tests\OAuthTestCase;

/**
 * Class DigitalRewardReceptionTest
 * @package Piggy\Api\Tests\OAuth\Loyalty\Rewards
 */
class DigitalRewardReceptionTest extends OAuthTestCase
{
    /**
     * @test
     * @throws RequestException
     */
    public function it_returns_a_digital_reward_reception()
    {
        $member = $this->createMember();
        $shop = $this->createShop();
        $digitalReward = new DigitalReward(1, "test reward");
        $digitalRewardReception = new DigitalRewardReception(1, "test reward reception", 100, $member, $digitalReward);

        $this->addExpectedResponse([
            "id" => $digitalRewardReception->getId(),
            "credits" => $digitalRewardReception->getCredits(),
            "title" => $digitalRewardReception->getTitle(),
            "digital_reward" => [
                "id" => $digitalReward->getId(),
                "title" => $digitalReward->getTitle(),
            ],
            "member" => [
                "id" => $member->getId(),
                "email" => $member->getEmail()
            ],
        ]);

        $loyaltyCard = new LoyaltyCard(1, "1234", CardType::PHYSICAL, CardStatus::ACTIVE, $member);
        $data = $this->mockedClient->digitalRewardReceptions->create($shop, $digitalReward, $loyaltyCard);

        $this->assertEquals($data->getId(), $digitalRewardReception->getId());
        $this->assertEquals($data->getCredits(), $digitalRewardReception->getCredits());
        $this->assertEquals($data->getTitle(), $digitalRewardReception->getTitle());

        $this->assertEquals($data->getDigitalReward()->getId(), $digitalRewardReception->getDigitalReward()->getId());
        $this->assertEquals($data->getDigitalReward()->getTitle(),
            $digitalRewardReception->getDigitalReward()->getTitle());

        $this->assertEquals($data->getMember()->getId(), $digitalRewardReception->getMember()->getId());
        $this->assertEquals($data->getMember()->getEmail(), $digitalRewardReception->getMember()->getEmail());
    }
}
