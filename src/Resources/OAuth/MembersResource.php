<?php

namespace Piggy\Api\Resources\OAuth;

use Piggy\Api\Exceptions\RequestException;
use Piggy\Api\Mappers\MemberMapper;
use Piggy\Api\Mappers\MemberResponseMapper;
use Piggy\Api\Model\Member;
use Piggy\Api\Model\MemberResponse;
use Piggy\Api\Resources\BaseResource;

/**
 * Class MembersResource
 * @package Piggy\Api\Resources\OAuth
 */
class MembersResource extends BaseResource
{
    /**
     * @var string
     */
    protected $resourceUri = "/api/v2/oauth/clients/members";

    /**
     * @param int $shopId
     * @param string $email
     * @return Member
     * @throws RequestException
     */
    public function create(int $shopId, string $email): Member
    {
        $body = [
            "shop_id" => $shopId,
            "email" => $email,
        ];

        $response = $this->client->request('POST', $this->resourceUri, $body);

        $mapper = new MemberMapper();

        return $mapper->mapFromResponse($this->getDataFromResponse($response));
    }

    /**
     * @param int $shopId
     * @param string $email
     * @return MemberResponse
     * @throws RequestException
     */
    public function findOneBy(int $shopId, string $email): MemberResponse
    {
        $body = [
            "shop_id" => $shopId,
            "email" => $email,
        ];

        $response = $this->client->request('GET', $this->resourceUri . "/find-one-by", $body);

        $mapper = new MemberResponseMapper();

        return $mapper->mapFromResponse($this->getDataFromResponse($response));
    }

    /**
     * @param int $shopId
     * @param int $id
     * @return Member
     * @throws RequestException
     */
    public function get(int $shopId, int $id): Member
    {
        $body = [
            "shop_id" => $shopId,
        ];

        $response = $this->client->request('GET', $this->resourceUri . "/" . $id, $body);

        $mapper = new MemberMapper();

        return $mapper->mapFromResponse($this->getDataFromResponse($response));
    }
}
