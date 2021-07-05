<?php

namespace Piggy\Api\Tests\OAuth\Loyalty\Rewards;

use Piggy\Api\Enum\CardStatus;
use Piggy\Api\Enum\CardType;
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
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Piggy\Api\Exceptions\PiggyRequestException
     */
    public function it_returns_a_physical_reward_reception()
    {
        $member = $this->createMember();
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

        $data = $this->mockedClient->physicalRewardReceptions->create(1, 2, 3);

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
