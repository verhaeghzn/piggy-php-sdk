<?php
//
//namespace Piggy\Api\Tests\OAuth\Loyalty;
//
//use Exception;
//use Piggy\Api\Exceptions\InputInvalidException;
//use Piggy\Api\Exceptions\RequestException;
//use Piggy\Api\Models\Loyalty\CreditReception;
//use Piggy\Api\Models\Loyalty\StagedCreditReception;
//use Piggy\Api\Tests\OAuthTestCase;
//
///**
// * Class CreditReceptionsResourceTest
// * @package Piggy\Api\Tests\OAuth\Loyalty
// */
//class CreditReceptionsResourceTest extends OAuthTestCase
//{
//    /**
//     * @test
//     * @throws RequestException
//     * @throws Exception
//     */
//    public function it_returns_a_staged_credit_reception()
//    {
//        $stagedCreditReception = new StagedCreditReception(1, 200,  "2021-04-10T08:04:01+00:00", null);
//
//        $this->addExpectedResponse([
//            "id" => $stagedCreditReception->getId(),
//            "credits" => $stagedCreditReception->getCredits(),
//            "purchase_amount" => $stagedCreditReception->getPurchaseAmount(),
//            "created_at" => $stagedCreditReception->getCreatedAt()->format("Y-m-d H:i:s"),
//        ]);
//
//        $data = $this->mockedClient->stagedCreditReceptions->get(1);
//
//        $this->assertEquals($data->getId(), $stagedCreditReception->getId());
//        $this->assertEquals($data->getCredits(), $stagedCreditReception->getCredits());
//        $this->assertEquals($data->getPurchaseAmount(), $stagedCreditReception->getPurchaseAmount());
//        $this->assertEquals($data->getCreatedAt(), $stagedCreditReception->getCreatedAt());
//    }
//
//    /**
//     * @test
//     * @throws \GuzzleHttp\Exception\GuzzleException
//     * @throws \Piggy\Api\Exceptions\InputInvalidException
//     * @throws \Piggy\Api\Exceptions\PiggyRequestException
//     */
//    public function it_throws_input_invalid_exception_when_member_and_loyalty_card_is_missing()
//    {
//        $shop = $this->createShop();
//
//        $this->expectExceptionMessage("Member or LoyaltyCard is required");
//
//        $data = $this->mockedClient->creditReceptions->create($shop, null, null, 1, 1);
//    }
//
//    /**
//     * @test
//     * @throws \GuzzleHttp\Exception\GuzzleException
//     * @throws \Piggy\Api\Exceptions\InputInvalidException
//     * @throws \Piggy\Api\Exceptions\PiggyRequestException
//     */
//    public function it_throws_input_invalid_exception_when_credits_and_purchase_amount_is_missing()
//    {
//        $shop = $this->createShop();
//        $member = $this->createMember();
//
//        $this->expectExceptionMessage("Purchase amount or credits is required");
//
//        $data = $this->mockedClient->creditReceptions->create($shop, $member);
//    }
//}
