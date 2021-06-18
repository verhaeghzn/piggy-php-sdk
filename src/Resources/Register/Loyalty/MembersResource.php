<?php

namespace Piggy\Api\Resources\Register\Loyalty;

use Piggy\Api\Mappers\Loyalty\MemberAndCreditBalanceResponseMapper;
use Piggy\Api\Mappers\Loyalty\MemberMapper;
use Piggy\Api\Models\Loyalty\Member;
use Piggy\Api\Models\Loyalty\MemberResponse;
use Piggy\Api\Resources\BaseResource;

/**
 * Class MembersResource
 * @package Piggy\Api\Resources\Register\Loyalty
 */
class MembersResource extends BaseResource
{
    /**
     * @var string
     */
    protected $resourceUri = "/api/v1/register/members";

    /**
     * @param string $email
     *
     * @return Member
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Piggy\Api\Exceptions\PiggyRequestException
     */
    public function create(string $email): Member
    {
        $response = $this->client->post($this->resourceUri, [
            "email" => $email,
        ]);

        $mapper = new MemberMapper();

        return $mapper->map($response->getData());
    }

    /**
     * @param string $email
     *
     * @return MemberResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Piggy\Api\Exceptions\PiggyRequestException
     */
    public function findOneBy(string $email): MemberResponse
    {
        $response = $this->client->get("{$this->resourceUri}/find-one-by", [
            "email" => $email,
        ]);

        $mapper = new MemberAndCreditBalanceResponseMapper();

        return $mapper->map($response->getData());
    }

    /**
     * @param int $id
     *
     * @return MemberResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Piggy\Api\Exceptions\PiggyRequestException
     */
    public function get(int $id): MemberResponse
    {
        $response = $this->client->get("{$this->resourceUri}/{$id}");

        $mapper = new MemberAndCreditBalanceResponseMapper();

        return $mapper->map($response->getData());
    }
}
