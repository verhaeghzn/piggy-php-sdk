<?php

namespace Piggy\Api\Tests\OAuth\Shops;

use Piggy\Api\Enum\ShopType;
use Piggy\Api\Exceptions\RequestException;
use Piggy\Api\Tests\OAuthTestCase;

/**
 * Class WebshopsResourceTest
 * @package Piggy\Api\Tests\OAuth\Shops
 */
class WebshopsResourceTest extends OAuthTestCase
{
    /**
     * @test
     * @throws RequestException
     */
    public function it_returns_all_webshops()
    {
        $webshop1 = $this->createShop(ShopType::WEB);
        $webshop2 = $this->createShop(ShopType::WEB);
        $webshops = [$webshop1, $webshop1];
        $loyaltyProgram = $this->createLoyaltyProgram();

        $this->addExpectedResponse([
            [
                "id" => $webshop1->getId(),
                "name" => $webshop1->getName(),
                "loyalty_program" => null
            ],
            [
                "id" => $webshop2->getId(),
                "name" => $webshop2->getName(),
                "loyalty_program" => [
                    "id" => $loyaltyProgram->getId(),
                    "name" => $loyaltyProgram->getName()
                ]
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

        $this->assertEquals($fetchedWebshop1->getLoyaltyProgram(), null);

        $this->assertEquals($fetchedWebshop2->getLoyaltyProgram()->getId(), $loyaltyProgram->getId());
        $this->assertEquals($fetchedWebshop2->getLoyaltyProgram()->getName(), $loyaltyProgram->getName());
    }

    /**
     * @test
     */
    public function it_returns_a_webshop()
    {
        $webshop = $this->createShop(ShopType::WEB);
        $loyaltyProgram = $this->createLoyaltyProgram();

        $this->addExpectedResponse([
            "id" => $webshop->getId(),
            "name" => $webshop->getName(),
            "loyalty_program" => [
                "id" => $loyaltyProgram->getId(),
                "name" => $loyaltyProgram->getName()
            ],
        ]);

        $data = $this->mockedClient->webshops->get(1);

        $this->assertEquals($data->getId(), $webshop->getId());
        $this->assertEquals($data->getName(), $webshop->getName());
        $this->assertEquals($data->getLoyaltyProgram()->getId(), $loyaltyProgram->getId());
        $this->assertEquals($data->getLoyaltyProgram()->getName(), $loyaltyProgram->getName());
    }
}
