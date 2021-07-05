<?php

namespace Piggy\Api\Tests\OAuth\Loyalty;

use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Piggy\Api\Exceptions\InputInvalidException;
use Piggy\Api\Exceptions\PiggyRequestException;
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
     * @throws GuzzleException
     * @throws PiggyRequestException
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
     * @throws GuzzleException
     * @throws InputInvalidException
     * @throws PiggyRequestException
     */
    public function it_throws_input_invalid_exception_when_member_and_loyalty_card_is_missing()
    {
        $this->expectExceptionMessage("Member or LoyaltyCard is required");
        $this->mockedClient->creditReceptions->create(1, null, null, 1, 1);
    }

    /**
     * @test
     * @throws GuzzleException
     * @throws InputInvalidException
     * @throws PiggyRequestException
     */
    public function it_throws_input_invalid_exception_when_credits_and_purchase_amount_is_missing()
    {
        $this->expectExceptionMessage("Purchase amount or credits is required");
        $this->mockedClient->creditReceptions->create(1, 2);
    }
}
