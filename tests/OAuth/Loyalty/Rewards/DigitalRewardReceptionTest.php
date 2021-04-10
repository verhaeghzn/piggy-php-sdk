<?php

namespace Tests\OAuth\Loyalty\Rewards;

use Piggy\Api\Enum\CardStatus;
use Piggy\Api\Enum\CardType;
use Piggy\Api\Exceptions\RequestException;
use Piggy\Api\Models\Loyalty\LoyaltyCard;
use Piggy\Api\Models\Loyalty\Member;
use Piggy\Api\Models\Loyalty\RewardReceptions\DigitalRewardReception;
use Piggy\Api\Models\Loyalty\Rewards\DigitalReward;
use Tests\OAuthTestCase;

/**
 * Class DigitalRewardReceptionTest
 * @package Tests\OAuth\Loyalty
 */
class DigitalRewardReceptionTest extends OAuthTestCase
{
    /**
     * @test
     * @throws RequestException
     */
    public function it_returns_a_digital_reward_reception()
    {
        $member = new Member(1, "tests@piggy.nl");
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
        $data = $this->mockedClient->digitalRewardReceptions->create(1, $digitalReward, $loyaltyCard);

        $this->assertEquals($data->getId(), $digitalRewardReception->getId());
        $this->assertEquals($data->getCredits(), $digitalRewardReception->getCredits());
        $this->assertEquals($data->getTitle(), $digitalRewardReception->getTitle());

        $this->assertEquals($data->getDigitalReward()->getId(), $digitalRewardReception->getDigitalReward()->getId());
        $this->assertEquals($data->getDigitalReward()->getTitle(), $digitalRewardReception->getDigitalReward()->getTitle());

        $this->assertEquals($data->getMember()->getId(), $digitalRewardReception->getMember()->getId());
        $this->assertEquals($data->getMember()->getEmail(), $digitalRewardReception->getMember()->getEmail());
    }
}
