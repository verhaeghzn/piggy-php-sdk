<?php

namespace Piggy\Api\Http\Traits;

use Piggy\Api\Http\BaseClient;
use Piggy\Api\Resources\OAuth\Giftcards\GiftcardsResource;
use Piggy\Api\Resources\OAuth\Giftcards\GiftcardTransactionsResource;
use Piggy\Api\Resources\OAuth\Loyalty\CreditReceptionsResource;
use Piggy\Api\Resources\OAuth\Loyalty\LoyaltyCardsResource;
use Piggy\Api\Resources\OAuth\Loyalty\MembersResource;
use Piggy\Api\Resources\OAuth\Loyalty\Rewards\DigitalRewardReceptionsResource;
use Piggy\Api\Resources\OAuth\Loyalty\Rewards\ExternalRewardReceptionsResource;
use Piggy\Api\Resources\OAuth\Loyalty\Rewards\PhysicalRewardReceptionsResource;
use Piggy\Api\Resources\OAuth\Loyalty\Rewards\RewardsResource;
use Piggy\Api\Resources\OAuth\Loyalty\StagedCreditReceptionsResource;
use Piggy\Api\Resources\OAuth\Shops\WebshopsResource;

/**
 * Trait SetsOAuthResources
 * @package Piggy\Api\Http\Traits
 */
trait SetsOAuthResources
{
    /**
     * @var MembersResource
     */
    public $members;

    /**
     * @var WebshopsResource
     */
    public $webshops;

    /**
     * @var CreditReceptionsResource
     */
    public $creditReceptions;

    /**
     * @var StagedCreditReceptionsResource
     */
    public $stagedCreditReceptions;

    /**
     * @var LoyaltyCardsResource
     */
    public $loyaltyCards;

    /**
     * @var RewardsResource
     */
    public $rewards;

    /**
     * @var DigitalRewardReceptionsResource
     */
    public $digitalRewardReceptions;

    /**
     * @var ExternalRewardReceptionsResource
     */
    public $externalRewardReceptions;

    /**
     * @var PhysicalRewardReceptionsResource
     */
    public $physicalRewardReceptions;

    /**
     * @var GiftcardsResource;
     */
    public $giftcards;

    /**
     * @var GiftcardTransactionsResource
     */
    public $giftcardTransactions;

    /**
     * @param BaseClient $client
     */
    protected function setResources(BaseClient $client)
    {
        $this->members = new MembersResource($client);
        $this->webshops = new WebshopsResource($client);
        $this->creditReceptions = new CreditReceptionsResource($client);
        $this->stagedCreditReceptions = new StagedCreditReceptionsResource($client);
        $this->loyaltyCards = new LoyaltyCardsResource($client);
        $this->rewards = new RewardsResource($client);
        $this->digitalRewardReceptions = new DigitalRewardReceptionsResource($client);
        $this->externalRewardReceptions = new ExternalRewardReceptionsResource($client);
        $this->physicalRewardReceptions = new PhysicalRewardReceptionsResource($client);
        $this->giftcards = new GiftcardsResource($client);
        $this->giftcardTransactions = new GiftcardTransactionsResource($client);
    }
}
