<?php

namespace Piggy\Api\Exceptions;

class Error
{
    /**
     * @var
     */
    protected $key;

    /**
     * @var array
     */
    protected $errors;

    /**
     * Error constructor.
     * @param $key
     * @param $errors
     */
    public function __construct($key, $errors)
    {
        $this->key = $key;
        $this->errors = $errors;
    }

    /**
     * @return mixed
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}