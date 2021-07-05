<?php

namespace Piggy\Api\Tests\OAuth\Loyalty\Rewards;

use GuzzleHttp\Exception\GuzzleException;
use Piggy\Api\Exceptions\PiggyRequestException;
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
     * @throws GuzzleException
     * @throws PiggyRequestException
     */
    public function it_returns_a_digital_reward_reception()
    {
        $member = $this->createMember();
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

        $data = $this->mockedClient->digitalRewardReceptions->create(1, 2, 3);

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
