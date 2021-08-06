<?php

namespace Piggy\Api\Tests;

use DateTime;
use DateTimeInterface;
use GuzzleHttp\Client as HttpClient;

use PHPUnit\Framework\TestCase;
use Piggy\Api\Enum\ShopType;
use Piggy\Api\Models\Loyalty\LoyaltyProgram;
use Piggy\Api\Models\Loyalty\Member;
use Piggy\Api\Models\Shops\PhysicalShop;
use Piggy\Api\Models\Shops\Shop;
use Piggy\Api\Models\Shops\Webshop;
use function Piggy\Api\hasGuzzle5;

/**
 * Class BaseTestCase
 * @package Piggy\Api\Tests
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

        if (hasGuzzle5()) {
            $mock = new MockHandlerAdapter();
            $httpClient = new HttpClient(['handler' => $mock]);
        } else {
            $mock = new \GuzzleHttp\Handler\MockHandler();
            $handlerStack = \GuzzleHttp\HandlerStack::create($mock);
            $httpClient = new HttpClient(['handler' => $handlerStack]);
        }

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
        $payload = json_encode([
            "data" => $data,
            "meta" => $meta
        ]);

        if (hasGuzzle5()) {
            $stream = fopen('php://memory','r+');
            fwrite($stream, $payload);
            rewind($stream);

            $streamWrapper = new \GuzzleHttp\Stream\Stream($stream);
            $response = new \GuzzleHttp\Message\Response($code, [], $streamWrapper);
        } else {
            $response = new \GuzzleHttp\Psr7\Response($code, [], $payload);
        }

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
    public function getMockHandler()
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
