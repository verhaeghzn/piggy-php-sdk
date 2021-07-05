<?php

namespace Piggy\Api\Tests\OAuth\Loyalty\Rewards;

use GuzzleHttp\Exception\GuzzleException;
use Piggy\Api\Exceptions\PiggyRequestException;
use Piggy\Api\Models\Loyalty\RewardReceptions\ExternalRewardReception;
use Piggy\Api\Models\Loyalty\Rewards\ExternalReward;
use Piggy\Api\Tests\OAuthTestCase;

/**
 * Class ExternalRewardReceptionTest
 * @package Piggy\Api\Tests\OAuth\Loyalty\Rewards
 */
class ExternalRewardReceptionTest extends OAuthTestCase
{
    /**
     * @test
     * @throws GuzzleException
     * @throws PiggyRequestException
     */
    public function it_returns_a_external_reward_reception()
    {
        $member = $this->createMember();
        $externalReward = new ExternalReward(1, "test reward");
        $externalRewardReception = new ExternalRewardReception(1, "test reward reception", 100, $member,
            $externalReward);

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

        $data = $this->mockedClient->externalRewardReceptions->create(1, 2, 3);

        $this->assertEquals($data->getId(), $externalRewardReception->getId());
        $this->assertEquals($data->getCredits(), $externalRewardReception->getCredits());
        $this->assertEquals($data->getTitle(), $externalRewardReception->getTitle());

        $this->assertEquals($data->getExternalReward()->getId(),
            $externalRewardReception->getExternalReward()->getId());
        $this->assertEquals($data->getExternalReward()->getTitle(),
            $externalRewardReception->getExternalReward()->getTitle());

        $this->assertEquals($data->getMember()->getId(), $externalRewardReception->getMember()->getId());
        $this->assertEquals($data->getMember()->getEmail(), $externalRewardReception->getMember()->getEmail());
    }
}
