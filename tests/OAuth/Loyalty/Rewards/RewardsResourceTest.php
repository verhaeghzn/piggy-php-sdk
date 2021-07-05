<?php

namespace Piggy\Api\Tests\OAuth\Loyalty\Rewards;

use Piggy\Api\Models\Loyalty\Rewards\DigitalReward;
use Piggy\Api\Models\Loyalty\Rewards\ExternalReward;
use Piggy\Api\Models\Loyalty\Rewards\PhysicalReward;
use Piggy\Api\Tests\OAuthTestCase;

/**
 * Class RewardsResourceTest
 * @package Piggy\Api\Tests\OAuth\Loyalty\Rewards
 */
class RewardsResourceTest extends OAuthTestCase
{
    /**
     * @test
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Piggy\Api\Exceptions\PiggyRequestException
     */
    public function it_returns_all_rewards()
    {
        $shop = $this->createShop();
        $digitalReward1 = new DigitalReward(1, "digital reward 1");
        $digitalReward2 = new DigitalReward(2, "digital reward 2");

        $physicalReward1 = new PhysicalReward(3, "physical reward 1");
        $physicalReward2 = new PhysicalReward(4, "physical reward 2");

        $externalReward1 = new ExternalReward(5, "external reward 1");
        $externalReward2 = new ExternalReward(6, "external reward 2");

        $rewards = [
            "physical" => [
                $physicalReward1,
                $physicalReward2,
            ],
            "digital" => [
                $digitalReward1,
                $digitalReward2,
            ],
            "external" => [
                $externalReward1,
                $externalReward2
            ]
        ];

        $this->addExpectedResponse([
            "digital" => [
                [
                    "id" => $digitalReward1->getId(),
                    "title" => $digitalReward1->getTitle(),

                ],
                [
                    "id" => $digitalReward2->getId(),
                    "title" => $digitalReward2->getTitle(),
                ]
            ],
            "physical" => [
                [
                    "id" => $physicalReward1->getId(),
                    "title" => $physicalReward1->getTitle(),
                ],
                [
                    "id" => $physicalReward2->getId(),
                    "title" => $physicalReward2->getTitle(),
                ]
            ],
            "external" => [
                [
                    "id" => $externalReward1->getId(),
                    "title" => $externalReward1->getTitle(),
                ],
                [
                    "id" => $externalReward2->getId(),
                    "title" => $externalReward2->getTitle(),
                ]
            ]
        ]);

        $data = $this->mockedClient->rewards->all(1);

        $physicalRewards = $data["physical"];
        $digitalRewards = $data["digital"];
        $externalRewards = $data["external"];

        $this->assertCount(count($rewards), $data);
        $this->assertCount(count($rewards["physical"]), $physicalRewards);
        $this->assertCount(count($rewards["digital"]), $digitalRewards);
        $this->assertCount(count($rewards["external"]), $externalRewards);

        $this->assertEquals($rewards["physical"], $physicalRewards);
        $this->assertEquals($rewards["digital"], $digitalRewards);
        $this->assertEquals($rewards["external"], $externalRewards);
    }
}
