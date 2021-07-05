<?php

namespace Piggy\Api\Tests\OAuth\Marketing;

use DateTimeInterface;
use GuzzleHttp\Exception\GuzzleException;
use Piggy\Api\Exceptions\PiggyRequestException;
use Piggy\Api\Models\Marketing\MarketingProgram;
use Piggy\Api\Models\Marketing\MarketingRecipient;
use Piggy\Api\Tests\OAuthTestCase;

/**
 * Class MarketingRecipientsResourceTest
 * @package Piggy\Api\Tests\OAuth\Marketing
 */
class MarketingRecipientsResourceTest extends OAuthTestCase
{
    /**
     * @test
     * @throws GuzzleException
     * @throws PiggyRequestException
     */
    public function it_returns_a_marketing_recipient_by_email()
    {
        $marketingProgram = new MarketingProgram(1, "test program");
        $marketingRecipient = new MarketingRecipient(1, "test@piggy.nl", true,$this->parseDate("2021-03-07T12:14:16+00:00"));

        $this->addExpectedResponse([
            "id" => $marketingRecipient->getId(),
            "email" => $marketingRecipient->getEmail(),
            "is_subscribed" => $marketingRecipient->isSubscribed(),
            "created_at" => $marketingRecipient->getCreatedAt()->format(DateTimeInterface::ATOM)
        ]);

        $data = $this->mockedClient->marketingRecipients->get(1, "test@piggy.nl");

        $this->assertEquals($data->getId(), $marketingRecipient->getId());
        $this->assertEquals($data->getEmail(), $marketingRecipient->getEmail());
        $this->assertEquals($data->getCreatedAt(), $marketingRecipient->getCreatedAt());
    }

    /**
     * @test
     * @throws GuzzleException
     * @throws PiggyRequestException
     */
    public function it_returns_a_marketing_recipient_after_creation()
    {
        $marketingProgram = new MarketingProgram(1, "test program");
        $marketingRecipient = new MarketingRecipient(1, "test@piggy.nl", true,$this->parseDate("2021-03-07T12:14:16+00:00"));

        $this->addExpectedResponse([
            "id" => $marketingRecipient->getId(),
            "email" => $marketingRecipient->getEmail(),
            "is_subscribed" => $marketingRecipient->isSubscribed(),
            "created_at" => $marketingRecipient->getCreatedAt()->format(DateTimeInterface::ATOM)
        ]);

        $data = $this->mockedClient->marketingRecipients->create(1, "test@piggy.nl");

        $this->assertEquals($data->getId(), $marketingRecipient->getId());
        $this->assertEquals($data->getEmail(), $marketingRecipient->getEmail());
        $this->assertEquals($data->getCreatedAt(), $marketingRecipient->getCreatedAt());
    }

    /**
     * @test
     * @throws GuzzleException
     * @throws PiggyRequestException
     */
    public function it_returns_a_marketing_recipient_after_update()
    {
        $marketingRecipient = new MarketingRecipient(1, "test@piggy.nl", true,$this->parseDate("2021-03-07T12:14:16+00:00"));

        $this->addExpectedResponse([
            "id" => $marketingRecipient->getId(),
            "email" => $marketingRecipient->getEmail(),
            "is_subscribed" => $marketingRecipient->isSubscribed(),
            "created_at" => $marketingRecipient->getCreatedAt()->format(DateTimeInterface::ATOM)
        ]);

        $data = $this->mockedClient->marketingRecipients->update($marketingRecipient);

        $this->assertEquals($data->getId(), $marketingRecipient->getId());
        $this->assertEquals($data->getEmail(), $marketingRecipient->getEmail());
        $this->assertEquals($data->getCreatedAt(), $marketingRecipient->getCreatedAt());
    }
}