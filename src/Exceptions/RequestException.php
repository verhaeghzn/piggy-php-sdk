<?php

namespace Piggy\Api\Exceptions;

use Exception;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response;
use Throwable;

/**
 * Class RequestException
 * @package Piggy\Api\Exceptions
 */
class RequestException extends Exception
{
    /**
     * @var string
     */
    protected $field;

    /**
     * @var Response|null
     */
    protected $response;

    /**
     * @var array
     */
    protected $links = [];

    /**
     * RequestException constructor.
     * @param string $message
     * @param int $code
     * @param null $field
     * @param Response|null $response
     * @param Throwable|null $previous
     */
    public function __construct(
        $message = "",
        $code = 0,
        $field = null,
        Response $response = null,
        Throwable $previous = null
    )
    {
        if (!empty($field)) {
            $this->field = (string)$field;
        }

        if (!empty($response)) {
            $this->response = $response;
        }

        parent::__construct($message, $code, $previous);
    }

    /**
     * @param GuzzleException $guzzleException
     * @param Throwable|null $previous
     * @return RequestException
     * @throws RequestException
     */
    public static function createFromGuzzleException(GuzzleException $guzzleException, Throwable $previous = null)
    {
        // Not all Guzzle Exceptions implement hasResponse() / getResponse()
        if (method_exists($guzzleException, 'hasResponse') && method_exists($guzzleException, 'getResponse')) {
            if ($guzzleException->hasResponse()) {
                return static::createFromResponse($guzzleException->getResponse());
            }
        }

        return new self($guzzleException->getMessage(), $guzzleException->getCode(), null, null, $previous);
    }

    /**
     * @param $response
     * @param Throwable|null $previous
     * @return RequestException
     * @throws RequestException
     */
    public static function createFromResponse(Response $response, Throwable $previous = null)
    {
        $object = static::parseResponseBody($response);

        $field = null;
        if (!empty($object->field)) {
            $field = $object->field;
        }
        
        if(isset($object->hint)) {
            $message = "Error executing API call ({$response->getStatusCode()}): {$object->message} | hint: {$object->hint}";
        } else {
            $message = "Error executing API call ({$response->getStatusCode()}): {$object->message}";
        }

        return new self(
            $message,
            $response->getStatusCode(),
            $field,
            $response,
            $previous
        );
    }

    /**
     * @return string
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * @return Response|null
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @return bool
     */
    public function hasResponse()
    {
        return $this->response !== null;
    }

    /**
     * @param Response $response
     * @return mixed
     * @throws RequestException
     */
    public static function parseResponseBody(Response $response)
    {
        $body = (string)$response->getBody();

        $object = @json_decode($body);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new self("Unable to decode Piggy response: '{$body}'.");
        }

        return $object;
    }
}