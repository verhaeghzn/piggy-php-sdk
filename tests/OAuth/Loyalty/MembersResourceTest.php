<?php

namespace Piggy\Api\Tests\OAuth\Loyalty;

use GuzzleHttp\Exception\GuzzleException;
use Piggy\Api\Exceptions\PiggyRequestException;
use Piggy\Api\Models\Loyalty\CreditBalance;
use Piggy\Api\Tests\OAuthTestCase;

/**
 * Class MembersResourceTest
 * @package Piggy\Api\Tests\OAuth\Loyalty
 */
class MembersResourceTest extends OAuthTestCase
{
    /**
     * @test
     * @throws GuzzleException
     * @throws PiggyRequestException
     */
    public function it_returns_the_member_after_creation()
    {
        $this->addExpectedResponse([
            "id" => 1,
            "email" => "new@piggy.nl",
        ]);

        $data = $this->mockedClient->members->create(1, 'new@piggy.nl');

        $this->assertEquals(1, $data->getId());
        $this->assertEquals("new@piggy.nl", $data->getEmail());
    }

    /**
     * @test
     */
    public function it_returns_member_by_email()
    {
        $member = $this->createMember();
        $creditBalance = new CreditBalance($member, 100);

        $this->addExpectedResponse([
            "member" => [
                "id" => $member->getId(),
                "email" => $member->getEmail(),
            ],
            "credit_balance" => [
                "balance" => $creditBalance->getBalance(),
            ],
        ]);

        $data = $this->mockedClient->members->findOneBy(1, $member->getEmail());

        $this->assertEquals($member->getEmail(), $data->getMember()->getEmail());
        $this->assertEquals($creditBalance->getBalance(), $data->getCreditBalance()->getBalance());
    }

    /**
     * @test
     */
    public function it_returns_member_by_id()
    {
        $member = $this->createMember();

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

        $data = $this->mockedClient->members->findOneBy(1, "piggy@piggy.nl");

        $this->assertEquals($member->getEmail(), $data->getMember()->getEmail());
        $this->assertEquals($creditBalance->getBalance(), $data->getCreditBalance()->getBalance());
    }
}
