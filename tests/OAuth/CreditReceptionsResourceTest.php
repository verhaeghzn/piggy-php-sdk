<?php

namespace Tests\OAuth;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Piggy\Api\Models\Loyalty\CreditReception;
use Piggy\Api\Models\Loyalty\Member;
use Piggy\Api\OAuthClient;

/**
 * Class CreditReceptionsResourceTest
 */
class CreditReceptionsResourceTest extends TestCase
{

    /**
     * @test
     */
    public function it_returns_a_credit_reception()
    {
        $member = new Member(1, "tests@piggy.nl");
        $creditReception = new CreditReception(1, 200, $member, "2021-04-10T08:04:01+00:00");

        $mock = new MockHandler([
            new Response(200, [], json_encode([
                "data" => [
                    "id" => $creditReception->getId(),
                    "credits" => $creditReception->getCredits(),
                    "created_at" => $creditReception->getCreatedAt(),
                    "member" => [
                        "id" => $member->getId(),
                        "email" => $member->getEmail()
                    ],
                ],
                "meta" => []
            ])),
        ]);

        $handlerStack = HandlerStack::create($mock);

        $httpClient = new HttpClient(['handler' => $handlerStack]);

        $oauthClient = new OAuthClient("1", "1", $httpClient);
        $oauthClient->addHeader("Authorization", 'Bearer token');

        $data = $oauthClient->creditReceptionsResource->get(1);

        $this->assertEquals($data->getId(), $creditReception->getId());
        $this->assertEquals($data->getCredits(), $creditReception->getCredits());
        $this->assertEquals($data->getMember()->getEmail(), $creditReception->getMember()->getEmail());
    }
}
