<?php

namespace Piggy\Api\Http\Traits;

use Piggy\Api\Http\BaseClient;
use Piggy\Api\Resources\OAuth\Loyalty\CreditReceptionsResource;
use Piggy\Api\Resources\OAuth\Loyalty\LoyaltyCardsResource;
use Piggy\Api\Resources\OAuth\Loyalty\MembersResource;
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
     * @param BaseClient $client
     */
    protected function setResources(BaseClient $client)
    {
        $this->members = new MembersResource($client);
        $this->webshops = new WebshopsResource($client);
        $this->creditReceptions = new CreditReceptionsResource($client);
        $this->stagedCreditReceptions = new StagedCreditReceptionsResource($client);
        $this->loyaltyCards = new LoyaltyCardsResource($client);
    }
}
