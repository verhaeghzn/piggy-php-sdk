<?php

namespace Piggy\Api\Resources;

use Piggy\Api\Http\BaseClient;

/**
 * Class BaseResource
 * @package Piggy\Api\Resources
 */
abstract class BaseResource
{
    /**
     * @var BaseClient $client
     */
    protected $client;

    /**
     * BaseResource constructor.
     * @param BaseClient $client
     */
    public function __construct($client)
    {
        $this->client = $client;
    }
}
