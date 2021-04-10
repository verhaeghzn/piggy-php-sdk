<?php

namespace Tests\OAuth\Loyalty;

use Exception;
use Piggy\Api\Exceptions\RequestException;
use Piggy\Api\Models\Loyalty\CreditReception;
use Piggy\Api\Models\Loyalty\Member;
use Tests\OAuthTestCase;

/**
 * Class CreditReceptionsResourceTest
 */
class CreditReceptionsResourceTest extends OAuthTestCase
{
    /**
     * @test
     * @throws RequestException
     * @throws Exception
     */
    public function it_returns_a_credit_reception()
    {
        $member = new Member(1, "tests@piggy.nl");
        $creditReception = new CreditReception(1, 200, $member, "2021-04-10T08:04:01+00:00");

        $this->addExpectedResponse([
            "id" => $creditReception->getId(),
            "credits" => $creditReception->getCredits(),
            "created_at" => $creditReception->getCreatedAt()->format("Y-m-d H:i:s"),
            "member" => [
                "id" => $member->getId(),
                "email" => $member->getEmail()
            ],
        ]);

        $data = $this->mockedClient->creditReceptionsResource->get(1);

        $this->assertEquals($data->getId(), $creditReception->getId());
        $this->assertEquals($data->getCredits(), $creditReception->getCredits());
        $this->assertEquals($data->getCreatedAt(), $creditReception->getCreatedAt());
        $this->assertEquals($data->getMember()->getEmail(), $creditReception->getMember()->getEmail());
    }

    /**
     *
     */
    public function it_returns_credit_reception_after_creation()
    {
        // Member on credit reception null || No member on credit reception at all || always send back member with credit reception
    }
}
