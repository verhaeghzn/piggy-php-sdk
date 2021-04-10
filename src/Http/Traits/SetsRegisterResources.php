<?php

namespace Piggy\Api\Http\Traits;

use Piggy\Api\Http\BaseClient;
use Piggy\Api\Resources\Register\MembersResource;

/**
 * Trait SetsRegisterResources
 * @package Piggy\Api
 */
trait SetsRegisterResources
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