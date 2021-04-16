<?php

namespace Piggy\Api\Tests;

use DateTime;
use DateTimeInterface;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Psr7\Response;
use Piggy\Api\Enum\GiftcardType;
use Piggy\Api\Enum\ShopType;
use Piggy\Api\Models\Giftcards\Giftcard;
use Piggy\Api\Models\Loyalty\LoyaltyProgram;
use Piggy\Api\Models\Loyalty\Member;
use Piggy\Api\Models\Shops\PhysicalShop;
use Piggy\Api\Models\Shops\Shop;
use Piggy\Api\Models\Shops\Webshop;

/**
 * Class BaseTestCase
 * @package Tests
 */
class BaseTestCase extends TestCase
{
    /**
     * @var HttpClient
     */
    protected $httpClient;

    /**
     * @var MockHandler
     */
    protected $mockHandler;

    /**
     *
     */
    protected function setUp(): void
    {
        parent::setUp();

        $mock = new MockHandler();
        $handlerStack = HandlerStack::create($mock);
        $httpClient = new HttpClient(['handler' => $handlerStack]);

        $this->httpClient = $httpClient;
        $this->mockHandler = $mock;
    }

    /**
     * @param array $data
     * @param array|null $meta
     * @param int $code
     */
    protected function addExpectedResponse(array $data, array $meta = null, int $code = 200)
    {
        $response = new Response($code, [], json_encode([
            "data" => $data,
            "meta" => $meta
        ]));

        $this->mockHandler->append($response);
    }

    /**
     * @param string $date
     * @return DateTime|false
     */
    public function parseDate(string $date)
    {
        return DateTime::createFromFormat(DateTimeInterface::ATOM, $date);
    }

    /**
     * @return HttpClient
     */
    public function getHttpClient(): HttpClient
    {
        return $this->httpClient;
    }

    /**
     * @return MockHandler
     */
    public function getMockHandler(): MockHandler
    {
        return $this->mockHandler;
    }

    /**
     * @return Member
     */
    public function createMember(): Member
    {
        $member = new Member(1, "piggy@piggy.nl");

        return $member;
    }

    /**
     * @param string $shopType
     * @return Shop
     */
    public function createShop($shopType = ShopType::PHYSICAL): Shop
    {
        if ($shopType == ShopType::PHYSICAL) {
            $shop = new PhysicalShop(1, "Shop name");
        } else {
            $shop = new Webshop(1, "Shop name");
        }

        return $shop;
    }

    /**
     * @return LoyaltyProgram
     */
    public function createLoyaltyProgram(): LoyaltyProgram
    {
        $loyaltyProgram = new LoyaltyProgram(1, "Loyalty program name");

        return $loyaltyProgram;
    }
}
