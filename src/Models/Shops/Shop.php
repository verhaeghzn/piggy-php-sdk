<?php

namespace Piggy\Api\Models\Shops;

/**
 * Class Shop
 * @package Piggy\Api\Models\Shops
 */
abstract class Shop
{
    /**
     * @var int|string
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * Shop constructor.
     * @param $id
     * @param string $name
     */
    public function __construct($id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    /**
     * @return int|string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
