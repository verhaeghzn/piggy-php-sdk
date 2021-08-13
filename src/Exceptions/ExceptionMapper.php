<?php

namespace Piggy\Api\Exceptions;

use Exception;
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
     * @param Exception $exception
     * @return Exception
     * @throws PiggyRequestException
     */
    public function map(Exception $exception)
    {
        if (method_exists($exception, 'hasResponse') && method_exists($exception, 'getResponse')) {

            if ($exception->getResponse()->getStatusCode() == 503) {
                throw new MaintenanceModeException("Piggy system is in maintenance mode.", 503);
            }

            if(property_exists($exception->getResponse(), 'getBody')) {
                $body = $exception->getResponse()->getBody();
                $body = @json_decode($body);

                if ($this->isPiggyException($body)) {
                    throw $this->mapPiggyException($body, $exception);
                }
            }
        }

        return $exception;
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