<?php

namespace Piggy\Api\Http;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use Piggy\Api\Exceptions\BadResponseException;
use Piggy\Api\Exceptions\RequestException;
use Piggy\Api\Http\Responses\AuthenticationResponse;
use Piggy\Api\Http\Responses\Response;
use Psr\Http\Message\ResponseInterface;
use Throwable;

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
     * @param ClientInterface|null $client
     */
    public function __construct(?ClientInterface $client = null)
    {
        if ($client) {
            $this->httpClient = $client;
        } else {
            $this->httpClient = new GuzzleClient();
        }
    }

    /**
     * @param $method
     * @param $endpoint
     * @param array $queryOptions
     * @return Response
     * @throws BadResponseException
     * @throws RequestException
     */
    public function request($method, $endpoint, $queryOptions = []): Response
    {
        if (!array_key_exists('Authorization', $this->headers)) {
            throw new RequestException('Authorization not set yet.');
        }

        $url = $this->baseUrl . $endpoint;

        $options = [
            "headers" => $this->headers,
            "form_params" => $queryOptions,
        ];

        try {
            $rawResponse = $this->httpClient->request($method, $url, $options);
            $response = $this->parseResponse($rawResponse);
            return $response;
        } catch (GuzzleException $e) {
            throw RequestException::createFromGuzzleException($e);
        }
    }

    /**
     * @param ResponseInterface $response
     * @return Response
     * @throws \Exception
     */
    private function parseResponse(ResponseInterface $response): Response
    {
        try {
            $content = json_decode($response->getBody()->getContents());
        } catch (Throwable $exception) {
            throw new BadResponseException("Could not decode response");
        }

        if (!property_exists($content, "data")) {
            throw new BadResponseException("Invalid response given. Data was missing from response");
        }

        if (!property_exists($content, "meta")) {
            throw new BadResponseException("Invalid response given. Meta was missing from response");
        }

        $response = new Response($content->data, $content->meta);

        return $response;
    }

    /**
     * @param $endpoint
     * @param array $queryOptions
     * @return AuthenticationResponse
     * @throws BadResponseException
     * @throws RequestException
     */
    public function authenticationRequest($endpoint, $queryOptions = []): AuthenticationResponse
    {
        $url = $this->baseUrl . $endpoint;

        $options = [
            "headers" => $this->headers,
            "form_params" => $queryOptions,
        ];

        try {
            $rawResponse = $this->httpClient->request("POST", $url, $options);
            $response = $this->parseAuthenticationResponse($rawResponse);
            return $response;
        } catch (GuzzleException $e) {
            throw RequestException::createFromGuzzleException($e);
        }
    }

    /**
     * @param ResponseInterface $response
     * @return AuthenticationResponse
     * @throws BadResponseException
     */
    private function parseAuthenticationResponse(ResponseInterface $response): AuthenticationResponse
    {
        try {
            $content = json_decode($response->getBody()->getContents());
            return new AuthenticationResponse($content);
        } catch (Throwable $exception) {
            throw new BadResponseException("Could not parse authentication response. Message: {$exception->getMessage()}"); // want to add response raw content to exception probably
        }
    }

    /**
     * @return string
     */
    public function getBaseUrl(): string
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

    /**
     * @param string $url
     * @param array $body
     * @return Response
     * @throws BadResponseException
     * @throws RequestException
     */
    public function post(string $url, array $body): Response
    {
        return $this->request('POST', $url, $body);
    }

    /**
     * @param string $url
     * @param array $params
     * @return Response
     * @throws BadResponseException
     * @throws RequestException
     */
    public function get(string $url, array $params = []): Response
    {
        $query = http_build_query($params);

        if ($query) {
            $url = "{$url}?{$query}";
        }

        return $this->request('GET', $url);
    }
}