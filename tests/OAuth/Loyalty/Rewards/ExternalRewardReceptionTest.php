<?php

namespace Tests\OAuth\Loyalty\Rewards;

use Piggy\Api\Enum\CardStatus;
use Piggy\Api\Enum\CardType;
use Piggy\Api\Exceptions\RequestException;
use Piggy\Api\Models\Loyalty\LoyaltyCard;
use Piggy\Api\Models\Loyalty\Member;
use Piggy\Api\Models\Loyalty\RewardReceptions\ExternalRewardReception;
use Piggy\Api\Models\Loyalty\Rewards\ExternalReward;
use Tests\OAuthTestCase;

/**
 * Class ExternalRewardReceptionTest
 * @package Tests\OAuth\Loyalty
 */
class ExternalRewardReceptionTest extends OAuthTestCase
{
    /**
     * @test
     * @throws RequestException
     */
    public function it_returns_a_external_reward_reception()
    {
        $member = new Member(1, "tests@piggy.nl");
        $externalReward = new ExternalReward(1, "test reward");
        $externalRewardReception = new ExternalRewardReception(1, "test reward reception", 100, $member, $externalReward);

        $this->addExpectedResponse([
            "id" => $externalRewardReception->getId(),
            "credits" => $externalRewardReception->getCredits(),
            "title" => $externalRewardReception->getTitle(),
            "external_reward" => [
                "id" => $externalReward->getId(),
                "title" => $externalReward->getTitle(),
            ],
            "member" => [
                "id" => $member->getId(),
                "email" => $member->getEmail()
            ],
        ]);

        $loyaltyCard = new LoyaltyCard(1, "1234", CardType::PHYSICAL, CardStatus::ACTIVE, $member);
        $data = $this->mockedClient->externalRewardReceptions->create(1, $externalReward, $loyaltyCard);

        $this->assertEquals($data->getId(), $externalRewardReception->getId());
        $this->assertEquals($data->getCredits(), $externalRewardReception->getCredits());
        $this->assertEquals($data->getTitle(), $externalRewardReception->getTitle());

        $this->assertEquals($data->getExternalReward()->getId(), $externalRewardReception->getExternalReward()->getId());
        $this->assertEquals($data->getExternalReward()->getTitle(), $externalRewardReception->getExternalReward()->getTitle());

        $this->assertEquals($data->getMember()->getId(), $externalRewardReception->getMember()->getId());
        $this->assertEquals($data->getMember()->getEmail(), $externalRewardReception->getMember()->getEmail());
    }
}
