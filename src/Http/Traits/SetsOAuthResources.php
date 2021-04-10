<?php

namespace Piggy\Api\Http\Traits;

use Piggy\Api\Http\BaseClient;
use Piggy\Api\Resources\OAuth\CreditReceptionsResource;
use Piggy\Api\Resources\OAuth\MembersResource;
use Piggy\Api\Resources\OAuth\StagedCreditReceptionsResource;
use Piggy\Api\Resources\OAuth\WebshopsResource;

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
    public $creditReceptionsResource;

    /**
     * @var StagedCreditReceptionsResource
     */
    public $stagedCreditReceptionsResource;

    /**
     * @param BaseClient $client
     */
    protected function setResources(BaseClient $client)
    {
        $this->members = new MembersResource($client);
        $this->webshops = new WebshopsResource($client);
        $this->creditReceptionsResource = new CreditReceptionsResource($client);
        $this->stagedCreditReceptionsResource = new StagedCreditReceptionsResource($client);
    }
}
