<?php

namespace Piggy\Api\Models\Loyalty\Rewards;

class Reward
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var int
     */
    protected $requiredCredits;

    /**
     * Reward constructor.
     * @param int $id
     * @param string $title
     * @param int|null $requiredCredits
     */
    public function __construct(int $id, string $title, ?int $requiredCredits = null)
    {
        $this->id = $id;
        $this->title = $title;
        $this->requiredCredits = $requiredCredits;
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
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return int|null
     */
    public function getRequiredCredits(): ?int
    {
        return $this->requiredCredits;
    }

    /**
     * @param int|null $requiredCredits
     */
    public function setRequiredCredits(?int $requiredCredits): void
    {
        $this->requiredCredits = $requiredCredits;
    }
}