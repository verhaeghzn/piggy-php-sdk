<?php

namespace Tests\OAuth;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Piggy\Api\Models\Loyalty\CreditBalance;
use Piggy\Api\Models\Loyalty\Member;
use Piggy\Api\OAuthClient;

/**
 * Class MembersResourceTest
 * @package Tests\OAuth\Resources
 */
class MembersResourceTest extends TestCase
{
    /**
     * @test
     */
    public function it_returns_the_member_after_creation()
    {
        $member = new Member(1, "mike@piggy.nl");
        $creditBalance = new CreditBalance($member, 100);

        $mock = new MockHandler([
            new Response(200, [], json_encode([
                "data" => [
                    "member" => [
                        "id" => $member->getId(),
                        "email" => $member->getEmail(),
                    ],
                    "credit_balance" => [
                        "id" => 1,
                        "balance" => 100,
                    ],
                ],
                "meta" => []
            ])),
        ]);

        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack]);

        $oauthClient = new OAuthClient("1", "1", $client);
        $oauthClient->addHeader("Authorization", 'Bearer token');

        $data = $oauthClient->members->get(1,1);

        $this->assertEquals($member->getId(), $data->getMember()->getId());
        $this->assertEquals($member->getEmail(), $data->getMember()->getEmail());
        $this->assertEquals($creditBalance->getBalance(), $data->getCreditBalance()->getBalance());
    }
}
