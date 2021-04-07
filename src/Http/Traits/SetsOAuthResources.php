<?php

namespace Piggy\Api\Traits;

use Piggy\Api\Http\BaseClient;
use Piggy\Api\Resources\OAuth\MembersResource;

/**
 * Trait SetsOAuthResources
 * @package Piggy\Api\Traits
 */
trait SetsOAuthResources
{
    /**
     * @var MembersResource
     */
    public $members;

    /**
     * @param BaseClient $piggyApi
     */
    protected function setResources(BaseClient $piggyApi)
    {
        $this->members = new MembersResource($piggyApi);
    }
}