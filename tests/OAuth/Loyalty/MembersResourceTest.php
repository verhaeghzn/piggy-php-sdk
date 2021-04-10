<?php

namespace Tests\OAuth;

use Piggy\Api\Exceptions\RequestException;
use Piggy\Api\Models\Loyalty\CreditBalance;
use Piggy\Api\Models\Loyalty\Member;
use Tests\OAuthTestCase;

/**
 * Class MembersResourceTest
 * @package Tests\OAuth\Resources
 */
class MembersResourceTest extends OAuthTestCase
{
    /**
     * @test
     * @throws RequestException
     */
    public function it_returns_the_member_after_creation()
    {
        $member = new Member(1, "mike@piggy.nl");
        $this->addExpectedResponse([
            "id" => $member->getId(),
            "email" => $member->getEmail(),
        ]);

        $data = $this->mockedClient->members->create(1,'test@piggy.nl');

        $this->assertEquals($member->getId(), $data->getId());
        $this->assertEquals($member->getEmail(), $data->getEmail());
    }

    /**
     * @test
     */
    public function it_returns_member_by_email()
    {
        $member = new Member(1, "mike@piggy.nl");
        $creditBalance = new CreditBalance($member, 100);
        $this->addExpectedResponse([
            "member" => [
                "id" => $member->getId(),
                "email" => $member->getEmail(),
            ],
            "credit_balance" => [
                "id" => 1,
                "balance" => 100,
            ],
        ]);

        $data = $this->mockedClient->members->findOneBy(1,'tests@piggy.nl');

        $this->assertEquals($member->getEmail(), $data->getMember()->getEmail());
        $this->assertEquals($creditBalance->getBalance(), $data->getCreditBalance()->getBalance());
    }

    /**
     * @test
     */
    public function it_returns_member_by_id()
    {
        $member = new Member(1, "mike@piggy.nl");
        $creditBalance = new CreditBalance($member, 100);
        $this->addExpectedResponse([
            "member" => [
                "id" => $member->getId(),
                "email" => $member->getEmail(),
            ],
            "credit_balance" => [
                "id" => 1,
                "balance" => 100,
            ],
        ]);

        $data = $this->mockedClient->members->findOneBy(1,1);

        $this->assertEquals($member->getEmail(), $data->getMember()->getEmail());
        $this->assertEquals($creditBalance->getBalance(), $data->getCreditBalance()->getBalance());
    }
}
