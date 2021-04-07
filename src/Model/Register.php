<?php

namespace Piggy\Api\Model;

/**
 * Class Register
 * @package Piggy\Api\Model
 */
class Register
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $identifier;

    /**
     * @var ?string
     */
    protected $name;

    /**
     * @var PhysicalShop
     */
    protected $shop;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    /**
     * @param string $identifier
     */
    public function setIdentifier(string $identifier): void
    {
        $this->identifier = $identifier;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return PhysicalShop
     */
    public function getShop(): PhysicalShop
    {
        return $this->shop;
    }

    /**
     * @param PhysicalShop $shop
     */
    public function setShop(PhysicalShop $shop): void
    {
        $this->shop = $shop;
    }
}