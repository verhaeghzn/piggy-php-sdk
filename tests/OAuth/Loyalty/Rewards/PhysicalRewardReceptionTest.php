<?php

namespace Piggy\Api\Tests\OAuth\Loyalty\Rewards;

use Piggy\Api\Enum\CardStatus;
use Piggy\Api\Enum\CardType;
use Piggy\Api\Exceptions\RequestException;
use Piggy\Api\Models\Loyalty\LoyaltyCard;
use Piggy\Api\Models\Loyalty\RewardReceptions\PhysicalRewardReception;
use Piggy\Api\Models\Loyalty\Rewards\PhysicalReward;
use Piggy\Api\Tests\OAuthTestCase;

/**
 * Class PhysicalRewardReceptionTest
 * @package Piggy\Api\Tests\OAuth\Loyalty\Rewards
 */
class PhysicalRewardReceptionTest extends OAuthTestCase
{
    /**
     * @test
     * @throws RequestException
     */
    public function it_returns_a_physical_reward_reception()
    {
        $member = $this->createMember();
        $shop = $this->createShop();
        $physicalReward = new PhysicalReward(1, "test reward");
        $physicalRewardReception = new PhysicalRewardReception(1, "test reward reception", 100, $member,
            $physicalReward);

        $this->addExpectedResponse([
            "id" => $physicalRewardReception->getId(),
            "credits" => $physicalRewardReception->getCredits(),
            "title" => $physicalRewardReception->getTitle(),
            "physical_reward" => [
                "id" => $physicalReward->getId(),
                "title" => $physicalReward->getTitle(),
            ],
            "member" => [
                "id" => $member->getId(),
                "email" => $member->getEmail()
            ],
        ]);

        $loyaltyCard = new LoyaltyCard(1, "1234", CardType::PHYSICAL, CardStatus::ACTIVE, $member);
        $data = $this->mockedClient->physicalRewardReceptions->create($shop, $physicalReward, $loyaltyCard);

        $this->assertEquals($data->getId(), $physicalRewardReception->getId());
        $this->assertEquals($data->getCredits(), $physicalRewardReception->getCredits());
        $this->assertEquals($data->getTitle(), $physicalRewardReception->getTitle());

        $this->assertEquals($data->getPhysicalReward()->getId(),
            $physicalRewardReception->getPhysicalReward()->getId());
        $this->assertEquals($data->getPhysicalReward()->getTitle(),
            $physicalRewardReception->getPhysicalReward()->getTitle());

        $this->assertEquals($data->getMember()->getId(), $physicalRewardReception->getMember()->getId());
        $this->assertEquals($data->getMember()->getEmail(), $physicalRewardReception->getMember()->getEmail());
    }
}
