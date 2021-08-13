<?php

namespace Piggy\Api\Http;

use Exception;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use Piggy\Api\Exceptions\ExceptionMapper;
use Piggy\Api\Exceptions\MalformedResponseException;
use Piggy\Api\Exceptions\PiggyRequestException;
use Piggy\Api\Http\Responses\AuthenticationResponse;
use Piggy\Api\Http\Responses\Response;
use Throwable;
use function Piggy\Api\hasGuzzle5;

/**
 * Class BaseClient
 * @package Piggy\Api\Http
 */
abstract class BaseClient
{
    /**
     * @var ClientInterface
     */
    private $httpClient;

    /**
     * @var string
     */
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
     * @param string $method
     * @param string $endpoint
     * @param array $queryOptions
     * @return Response
     * @throws PiggyRequestException|Exception
     */
    public function request(string $method, string $endpoint, $queryOptions = []): Response
    {
        if (!array_key_exists('Authorization', $this->headers)) {
            throw new Exception('Authorization not set yet.');
        }

        $url = $this->baseUrl . $endpoint;

        try {
            $rawResponse = $this->getResponse($method, $url, [
                "headers" => $this->headers,
                "form_params" => $queryOptions,
            ]);

            $response = $this->parseResponse($rawResponse);

            return $response;
        } catch (Exception $e) {
            $exceptionMapper = new ExceptionMapper();
            throw $exceptionMapper->map($e);
        }
    }

    /**
     * @param Psr\Http\Message\ResponseInterface|\GuzzleHttp\Message\ResponseInterface $response
     * @return Response
     * @throws Exception
     */
    private function parseResponse($response): Response
    {
        try {
            $content = json_decode($response->getBody()->getContents());
        } catch (Throwable $exception) {
            throw new MalformedResponseException("Could not decode response");
        }

        if (!property_exists($content, "data")) {
            throw new MalformedResponseException("Invalid response given. Data property was missing from response.");
        }

        if (!property_exists($content, "meta")) {
            throw new MalformedResponseException("Invalid response given. Meta property was missing from response.");
        }

        return new Response($content->data, $content->meta);
    }

    /**
     * @param string $endpoint
     * @param array $queryOptions
     * @return AuthenticationResponse
     * @throws PiggyRequestException|Exception
     */
    public function authenticationRequest(string $endpoint, $queryOptions = []): AuthenticationResponse
    {
        $url = $this->baseUrl . $endpoint;

        try {
            $rawResponse = $this->getResponse("POST", $url, [
                "headers" => $this->headers,
                "form_params" => $queryOptions,
            ]);

            $content = json_decode($rawResponse->getBody()->getContents());

            return new AuthenticationResponse($content);
        } catch (Exception $e) {
            $exceptionMapper = new ExceptionMapper();
            throw $exceptionMapper->map($e);
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
     * @throws GuzzleException
     * @throws PiggyRequestException
     */
    public function post(string $url, array $body): Response
    {
        return $this->request('POST', $url, $body);
    }

    /**
     * @param string $url
     * @param array $body
     * @return Response
     * @throws GuzzleException
     * @throws PiggyRequestException
     */
    public function put(string $url, array $body): Response
    {
        return $this->request('PUT', $url, $body);
    }

    /**
     * @param string $url
     * @param array $params
     * @return Response
     * @throws GuzzleException
     * @throws PiggyRequestException
     */
    public function get(string $url, array $params = []): Response
    {
        $query = http_build_query($params);

        if ($query) {
            $url = "{$url}?{$query}";
        }

        return $this->request('GET', $url);
    }

    private function getResponse($method, $url, $options = [])
    {
        if (hasGuzzle5()) {
            // v5 does not have form_params, so we need to apply a trick.
            if (isset($options['form_params'])) {
                $options['body'] = http_build_query($options['form_params']);
                unset($options['form_params']);

                $options['headers']['Content-Type'] = 'application/x-www-form-urlencoded';
            }

            $request = $this->httpClient->createRequest($method, $url, $options);
            return $this->httpClient->send($request);
        }

        return $this->httpClient->request($method, $url, $options);
    }
}
