<?php

namespace Piggy\Api\Models\Loyalty;

/**
 * Class LoyaltyCard
 * @package Piggy\Api\Models\Loyalty
 */
class LoyaltyCard
{

    private $id;

    /**
     * @var string
     */
    private $hash;

    /**
     * LoyaltyCard constructor.
     * @param $id
     * @param string $hash
     */
    public function __construct($id, string $hash)
    {
        $this->id = $id;
        $this->hash = $hash;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getHash(): string
    {
        return $this->hash;
    }
}
