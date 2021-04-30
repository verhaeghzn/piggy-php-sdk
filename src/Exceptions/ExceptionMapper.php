<?php

namespace Piggy\Api\Exceptions;

use GuzzleHttp\Exception\GuzzleException;
use stdClass;
use Throwable;

/**
 * Class ExceptionMapper
 * @package Piggy\Api\Exceptions
 */
class ExceptionMapper
{
    /**
     * @param GuzzleException $guzzleException
     * @return GuzzleException
     * @throws PiggyRequestException
     */
    public function map(GuzzleException $guzzleException)
    {
        if (method_exists($guzzleException, 'hasResponse') && method_exists($guzzleException, 'getResponse')) {
            $body = $guzzleException->getResponse()->getBody();
            $body = @json_decode($body);

            if ($this->isPiggyException($body)) {
                throw $this->mapPiggyException($body, $guzzleException);
            }
        }

        return $guzzleException;
    }

    /**
     * @param stdClass $body
     * @return bool
     */
    private function isPiggyException(stdClass $body): bool
    {
        $statusCode = property_exists($body, "status_code");
        $code = property_exists($body, "code");
        $message = property_exists($body, "message");

        return $statusCode && $code && $message;
    }

    /**
     * @param stdClass $body
     * @param Throwable $previous
     * @return PiggyRequestException
     */
    private function mapPiggyException(stdClass $body, Throwable $previous): PiggyRequestException
    {
        $statusCode = $body->status_code;
        $code = $body->code;
        $message = $body->message;

        if (property_exists($body, "errors")) {
            $mappedErrors = [];

            foreach ($body->errors as $key => $errors) {
                $mappedErrors[] = new Error($key, $errors);
            }

            $errorBag = new ErrorBag($mappedErrors);
        } else {
            $errorBag = null;
        }

        $exception = new PiggyRequestException(
            $message,
            $code,
            $statusCode,
            $errorBag,
            $previous
        );

        return $exception;
    }
}