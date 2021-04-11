<?php

namespace Piggy\Api\Tests\OAuth\Loyalty;

use Piggy\Api\Exceptions\RequestException;
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
     * @throws RequestException
     */
    public function it_returns_the_member_after_creation()
    {
        $shop = $this->createShop();
        $this->addExpectedResponse([
            "id" => 1,
            "email" => "new@piggy.nl",
        ]);

        $data = $this->mockedClient->members->create($shop, 'new@piggy.nl');

        $this->assertEquals(1, $data->getId());
        $this->assertEquals("new@piggy.nl", $data->getEmail());
    }

    /**
     * @test
     */
    public function it_returns_member_by_email()
    {
        $member = $this->createMember();
        $shop = $this->createShop();
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

        $data = $this->mockedClient->members->findOneBy($shop, $member->getEmail());

        $this->assertEquals($member->getEmail(), $data->getMember()->getEmail());
        $this->assertEquals($creditBalance->getBalance(), $data->getCreditBalance()->getBalance());
    }

    /**
     * @test
     */
    public function it_returns_member_by_id()
    {
        $member = $this->createMember();
        $shop = $this->createShop();

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

        $data = $this->mockedClient->members->findOneBy($shop, "piggy@piggy.nl");

        $this->assertEquals($member->getEmail(), $data->getMember()->getEmail());
        $this->assertEquals($creditBalance->getBalance(), $data->getCreditBalance()->getBalance());
    }
}
