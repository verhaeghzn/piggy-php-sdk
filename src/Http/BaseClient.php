<?php

namespace Piggy\Api\Http;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;
use Piggy\Api\Exceptions\RequestException;
use Psr\Http\Message\ResponseInterface;

/**
 * Class BaseClient
 * @package Piggy\Api\Http
 */
abstract class BaseClient
{

    /** @var GuzzleClient */
    private $httpClient;

    /** @var $baseUrl */
    private $baseUrl = "https://api.piggy.nl";

    /**
     * @var array
     */
    protected $headers = [
        'Accept' => 'application/json',
    ];

    /**
     * BaseClient constructor.
     */
    public function __construct()
    {
        $this->httpClient = new GuzzleClient();
    }

    /**
     * @param $method
     * @param $endpoint
     * @param array $query_options
     * @return ResponseInterface
     * @throws RequestException
     */
    public function request($method, $endpoint, $query_options = [])
    {
        if (!array_key_exists('Authorization', $this->headers)) {
            throw new RequestException('Authorization not set yet.');
        }

        $url = $this->baseUrl . $endpoint;

        $options = [
            "headers" => $this->headers,
            "form_params" => $query_options,
        ];

        try {
            return $this->httpClient->request($method, $url, $options);
        } catch(GuzzleException $e) {
            throw RequestException::createFromGuzzleException($e);
        }
    }

    /**
     * @return mixed
     */
    public function getBaseUrl()
    {
        return $this->baseUrl;
    }

    /**
     * @param mixed $baseUrl
     */
    public function setBaseUrl($baseUrl): void
    {
        $this->baseUrl = $baseUrl;
    }

    /**
     * @param $key
     * @param $value
     */
    public function addHeader($key, $value): void
    {
        $this->headers[$key] = $value;
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }
}