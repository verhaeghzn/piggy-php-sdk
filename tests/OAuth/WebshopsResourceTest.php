<?php

namespace Tests\OAuth;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Piggy\Api\Models\Webshop;
use Piggy\Api\OAuthClient;
use Piggy\Api\Resources\OAuth\WebshopsResource;

/**
 * Class WebshopsResource
 * @package Tests\OAuth
 */
class WebshopsResourceTest extends TestCase
{
    /**
     * @test
     * @throws \Piggy\Api\Exceptions\BadResponseException
     * @throws \Piggy\Api\Exceptions\RequestException
     */
    public function it_returns_all_webshops()
    {
        $webshop1 = new Webshop(1, "webshop 1");
        $webshop2 = new Webshop(2, "webshop 2");
        $webshops = [$webshop1, $webshop1];

        //create response
        $mock = new MockHandler([
            new Response(200, [], json_encode([
                "data" => [
                    [
                        "id" => $webshop1->getId(),
                        "name" => $webshop1->getName(),
                    ],
                    [
                        "id" => $webshop2->getId(),
                        "name" => $webshop2->getName(),
                    ]
                ],
                "meta" => []
            ])),
        ]);

        $handlerStack = HandlerStack::create($mock);

        $httpClient = new HttpClient(['handler' => $handlerStack]);

        $oauthClient = new OAuthClient("1", "1", $httpClient);
        $oauthClient->addHeader("Authorization", 'Bearer token');

        $data = $oauthClient->webshops->all();

        $fetchedWebshop1 = $data[0];
        $fetchedWebshop2 = $data[1];

        $this->assertEquals(count($data), count($webshops));
        $this->assertEquals($fetchedWebshop1->getId(), $webshop1->getId());
        $this->assertEquals($fetchedWebshop1->getName(), $webshop1->getName());

        $this->assertEquals($fetchedWebshop2->getId(), $webshop2->getId());
        $this->assertEquals($fetchedWebshop2->getName(), $webshop2->getName());
    }


}