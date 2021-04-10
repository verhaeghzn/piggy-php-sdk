<?php

namespace Piggy\Api\Http\Traits;

use Piggy\Api\Http\BaseClient;
use Piggy\Api\Resources\Customer\ProfileResource;

/**
 * Trait SetsCustomerResources
 * @package Piggy\Api\Traits
 */
trait SetsCustomerResources
{
    /**
     * @var ProfileResource
     */
    public $profile;

    /**
     * @param BaseClient $client
     */
    protected function setResources(BaseClient $client)
    {
        $this->profile = new ProfileResource($client);
    }
}