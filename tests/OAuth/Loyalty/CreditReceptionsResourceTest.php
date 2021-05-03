<?php

namespace Piggy\Api\Tests\OAuth\Loyalty;

use Exception;
use Piggy\Api\Exceptions\InputInvalidException;
use Piggy\Api\Exceptions\RequestException;
use Piggy\Api\Models\Loyalty\CreditReception;
use Piggy\Api\Tests\OAuthTestCase;

/**
 * Class CreditReceptionsResourceTest
 * @package Piggy\Api\Tests\OAuth\Loyalty
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
        $creditReception = new CreditReception(1, 200,  "2021-04-10T08:04:01+00:00", 0);

        $this->addExpectedResponse([
            "id" => $creditReception->getId(),
            "credits" => $creditReception->getCredits(),
            "purchase_amount" => $creditReception->getPurchaseAmount(),
            "created_at" => $creditReception->getCreatedAt()->format("Y-m-d H:i:s"),
        ]);

        $data = $this->mockedClient->creditReceptions->get(1);

        $this->assertEquals($data->getId(), $creditReception->getId());
        $this->assertEquals($data->getCredits(), $creditReception->getCredits());
        $this->assertEquals($data->getPurchaseAmount(), $creditReception->getPurchaseAmount());
        $this->assertEquals($data->getCreatedAt(), $creditReception->getCreatedAt());
    }

    /**
     * @test
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Piggy\Api\Exceptions\InputInvalidException
     * @throws \Piggy\Api\Exceptions\PiggyRequestException
     */
    public function it_throws_input_invalid_exception_when_member_and_loyalty_card_is_missing()
    {
        $shop = $this->createShop();

        $this->expectExceptionMessage("Member or LoyaltyCard is required");

        $data = $this->mockedClient->creditReceptions->create($shop, null, null, 1, 1);
    }

    /**
     * @test
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Piggy\Api\Exceptions\InputInvalidException
     * @throws \Piggy\Api\Exceptions\PiggyRequestException
     */
    public function it_throws_input_invalid_exception_when_credits_and_purchase_amount_is_missing()
    {
        $shop = $this->createShop();
        $member = $this->createMember();

        $this->expectExceptionMessage("Purchase amount or credits is required");

        $data = $this->mockedClient->creditReceptions->create($shop, $member);
    }
}
