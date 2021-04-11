<?php

namespace Piggy\Api\Models\Loyalty;

/**
 * Class Member
 * @package Piggy\Api\Models
 */
class Member
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $email;

    /**
     * Member constructor.
     * @param int $id
     * @param string $email
     */
    public function __construct(int $id, string $email)
    {
        $this->id = $id;
        $this->email = $email;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }
}
