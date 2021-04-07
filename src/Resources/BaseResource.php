<?php

namespace Piggy\Api\Resources;

use Piggy\Api\Http\BaseClient;
use Psr\Http\Message\ResponseInterface;

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
    public function __construct(BaseClient $client)
    {
        $this->client = $client;
    }

    public function getDataFromResponse(ResponseInterface $response)
    {
        $contents = $response->getBody()->getContents();

        return $contents ? json_decode($contents)->data : null;
    }
}