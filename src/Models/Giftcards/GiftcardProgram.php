<?php

namespace Piggy\Api\Models\Giftcards;

/**
 * Class GiftcardProgram
 * @package Piggy\Api\Models\Giftcards
 */
class GiftcardProgram
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
     * GiftcardProgram constructor.
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