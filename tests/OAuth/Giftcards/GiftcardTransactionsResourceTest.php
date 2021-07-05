<?php

namespace Piggy\Api\Tests\OAuth\Giftcards;

use DateTimeInterface;
use GuzzleHttp\Exception\GuzzleException;
use Piggy\Api\Exceptions\PiggyRequestException;
use Piggy\Api\Models\Giftcards\GiftcardTransaction;
use Piggy\Api\Tests\OAuthTestCase;

/**
 * Class GiftcardTransactionsResourceTest
 * @package Piggy\Api\Tests\OAuth\Giftcards
 */
class GiftcardTransactionsResourceTest extends OAuthTestCase
{
    /**
     * @test
     * @throws GuzzleException
     * @throws PiggyRequestException
     */
    public function it_returns_giftcard_transaction_after_creation()
    {
        $giftcardTransaction = new GiftcardTransaction(1, 1000, $this->parseDate("2021-03-07T12:14:16+00:00"));

        $this->addExpectedResponse([
            "id" => $giftcardTransaction->getId(),
            "amount_in_cents" => $giftcardTransaction->getAmount(),
            "created_at" => $giftcardTransaction->getCreatedAt()->format(DateTimeInterface::ATOM),
        ]);

        $data = $this->mockedClient->giftcardTransactions->create(1, 2, 100);

        $this->assertEquals($data->getId(), $giftcardTransaction->getId());
        $this->assertEquals($data->getAmount(), $giftcardTransaction->getAmount());
        $this->assertEquals($data->getCreatedAt(), $giftcardTransaction->getCreatedAt());
    }
}
