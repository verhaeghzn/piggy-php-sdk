<?php

namespace Tests\OAuth;

use Piggy\Api\Exceptions\RequestException;
use Piggy\Api\Models\Shops\Webshop;
use Tests\OAuthTestCase;

/**
 * Class WebshopsResource
 * @package Tests\OAuth
 */
class WebshopsResourceTest extends OAuthTestCase
{
    /**
     * @test
     * @throws RequestException
     */
    public function it_returns_all_webshops()
    {
        $webshop1 = new Webshop(1, "webshop 1");
        $webshop2 = new Webshop(2, "webshop 2");
        $webshops = [$webshop1, $webshop1];

        $this->addExpectedResponse([
            [
                "id" => $webshop1->getId(),
                "name" => $webshop1->getName(),
            ],
            [
                "id" => $webshop2->getId(),
                "name" => $webshop2->getName(),
            ]
        ]);

        $data = $this->mockedClient->webshops->all();

        $fetchedWebshop1 = $data[0];
        $fetchedWebshop2 = $data[1];

        $this->assertEquals(count($data), count($webshops));
        $this->assertEquals($fetchedWebshop1->getId(), $webshop1->getId());
        $this->assertEquals($fetchedWebshop1->getName(), $webshop1->getName());

        $this->assertEquals($fetchedWebshop2->getId(), $webshop2->getId());
        $this->assertEquals($fetchedWebshop2->getName(), $webshop2->getName());
    }


}
