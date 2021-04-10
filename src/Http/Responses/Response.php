<?php

namespace Piggy\Api\Http\Responses;

use stdClass;

/**
 * Class Response
 * @package Piggy\Api\Http
 */
class Response
{
    /**
     * @var stdClass
     */
    private $data;
    /**
     * @var stdClass
     */
    private $meta;

    /**
     * Response constructor.
     * @param stdClass $data
     * @param stdClass $meta
     */
    public function __construct($data, $meta)
    {
        $this->data = $data;
        $this->meta = $meta;
    }

    /**
     * @return
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return
     */
    public function getMeta()
    {
        return $this->meta;
    }
}