<?php

namespace Piggy\Api\Tests\OAuth\Giftcards;

use DateTimeInterface;
use Piggy\Api\Enum\GiftcardType;
use Piggy\Api\Exceptions\RequestException;
use Piggy\Api\Models\Giftcards\Giftcard;
use Piggy\Api\Models\Giftcards\GiftcardProgram;
use Piggy\Api\Models\Giftcards\GiftcardTransaction;
use Piggy\Api\Tests\OAuthTestCase;

/**
 * Class GiftcardsResourceTest
 * @package Piggy\Api\Tests\OAuth\Shops
 */
class GiftcardTransactionsResourceTest extends OAuthTestCase
{
    /**
     * @test
     * @throws RequestException
     */
    public function it_returns_giftcard_transaction_after_creation()
    {
        $shop = $this->createShop();
        $giftcardTransaction = new GiftcardTransaction(1, 1000, $this->parseDate("2021-03-07T12:14:16+00:00"));
        $giftcardProgram = new GiftcardProgram(1, "program for test");
        $giftcard = new Giftcard(1, "giftcard123", GiftcardType::DIGITAL, true, true, $giftcardProgram);

        $this->addExpectedResponse([
            "id" => $giftcardTransaction->getId(),
            "amount_in_cents" => $giftcardTransaction->getAmount(),
            "created_at" => $giftcardTransaction->getCreatedAt()->format(DateTimeInterface::ATOM),
        ]);

        $data = $this->mockedClient->giftcardTransactions->create($shop, $giftcard,100);

        $this->assertEquals($data->getId(), $giftcardTransaction->getId());
        $this->assertEquals($data->getAmount(), $giftcardTransaction->getAmount());
        $this->assertEquals($data->getCreatedAt(), $giftcardTransaction->getCreatedAt());
    }
}
