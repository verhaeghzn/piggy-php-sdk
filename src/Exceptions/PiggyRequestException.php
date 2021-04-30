<?php

namespace Piggy\Api\Exceptions;

use Exception;
use Throwable;

/**
 * Class PiggyRequestException
 * @package Piggy\Api\Exceptions
 */
class PiggyRequestException extends Exception
{
    /**
     * @var int
     */
    protected $statusCode;

    /**
     * @var ErrorBag|null
     */
    protected $errorBag;

    /**
     * PiggyRequestException constructor.
     * @param string $message
     * @param int $code
     * @param int $statusCode
     * @param ErrorBag|null $errorBag
     * @param Throwable|null $previous
     */
    public function __construct(string $message, int $code, int $statusCode, ?ErrorBag $errorBag = null, Throwable $previous = null)
    {
        $this->statusCode = $statusCode;
        $this->errorBag = $errorBag;

        parent::__construct($message, $code, $previous);
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @return ErrorBag|null
     */
    public function getErrorBag(): ?ErrorBag
    {
        return $this->errorBag;
    }
}