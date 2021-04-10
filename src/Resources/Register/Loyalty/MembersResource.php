<?php

namespace Piggy\Api\Resources\Register\Loyalty;

use Piggy\Api\Exceptions\RequestException;
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
     * @return Member
     * @throws RequestException
     */
    public function create(string $email): Member
    {
        $body = [
            "email" => $email,
        ];

        $response = $this->client->post($this->resourceUri, $body);

        $mapper = new MemberMapper();

        return $mapper->map($response->getData());
    }

    /**
     * @param string $email
     * @return MemberResponse
     * @throws RequestException
     */
    public function findOneBy(string $email): MemberResponse
    {
        $body = [
            "email" => $email,
        ];

        $response = $this->client->get("{$this->resourceUri}/find-one-by", $body);

        $mapper = new MemberAndCreditBalanceResponseMapper();

        return $mapper->map($response->getData());
    }

    /**
     * @param int $id
     * @return MemberResponse
     * @throws RequestException
     */
    public function get(int $id): MemberResponse
    {
        $response = $this->client->get("{$this->resourceUri}/{$id}");

        $mapper = new MemberAndCreditBalanceResponseMapper();

        return $mapper->map($response->getData());
    }
}
