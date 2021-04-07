<?php

namespace Piggy\Api;

use Piggy\Api\Http\BaseClient;
use Piggy\Api\Traits\SetsRegisterResources as RegisterResources;

/**
 * Class RegisterClient
 * @package Piggy\Api
 */
class RegisterClient extends BaseClient
{
    use RegisterResources;

    /** @var string $apiKey */
    public $apiKey;

    /**
     * RegisterClient constructor.
     * @param string $apiKey
     */
    public function __construct(string $apiKey)
    {
        parent::__construct();

        $this->apiKey = $apiKey;
        $this->setApiKey($apiKey);
        $this->setResources($this);
    }

    /**
     * @param string $apiKey
     * @return RegisterClient
     */
    public function setApiKey(string $apiKey): self
    {
        $this->addHeader("Authorization", "Bearer {$apiKey}");
        return $this;
    }
}