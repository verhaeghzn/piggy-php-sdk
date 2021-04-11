<?php

namespace Piggy\Api\Http\Traits;

use Piggy\Api\Http\BaseClient;
use Piggy\Api\Resources\OAuth\Loyalty\MembersResource;

/**
 * Trait SetsRegisterResources
 * @package Piggy\Api\Http\Traits
 */
trait SetsRegisterResources
{
    /**
     * @var MembersResource
     */
    public $members;

    /**
     * @param BaseClient $client
     */
    protected function setResources(BaseClient $client)
    {
        $this->members = new MembersResource($client);
    }
}
