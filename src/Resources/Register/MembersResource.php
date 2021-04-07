<?php

namespace Piggy\Api\Resources\Register;

use Piggy\Api\Exceptions\RequestException;
use Piggy\Api\Mappers\MemberMapper;
use Piggy\Api\Mappers\MemberResponseMapper;
use Piggy\Api\Model\Member;
use Piggy\Api\Model\MemberResponse;
use Piggy\Api\Resources\BaseResource;

/**
 * Class MembersResource
 * @package Piggy\Api\Resources\Register
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

        $response = $this->client->request('POST', $this->resourceUri, $body);

        $mapper = new MemberMapper();

        return $mapper->mapFromResponse($this->getDataFromResponse($response));
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

        $response = $this->client->request('GET', $this->resourceUri . "/find-one-by", $body);

        $mapper = new MemberResponseMapper();

        return $mapper->mapFromResponse($this->getDataFromResponse($response));
    }

    /**
     * @param int $id
     * @return MemberResponse
     * @throws RequestException
     *
     */
    public function get(int $id): MemberResponse
    {
        $response = $this->client->request('GET', $this->resourceUri . "/" . $id, []);

        $mapper = new MemberResponseMapper();

        return $mapper->mapFromResponse($this->getDataFromResponse($response));
    }

//    /**
//     * @param int $id
//     * @param array $fields
//     * @return Member
//     * @throws RequestException
//     */
//    public function update(int $id, array $fields = []): MemberResponse
//    {
//        $response = $this->client->request('PUT', $this->resourceUri . "/" . $id, $fields);
//
//        $mapper = new MemberResponseMapper();
//
//        return $mapper->mapFromResponse($this->getDataFromResponse($response));
//    }

    // Not necessary since we already got credit balance at the show call?
    // public function getCreditBalance(int $id)

}