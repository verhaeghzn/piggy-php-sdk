<?php


namespace Piggy\Api\Mappers;

use DateTime;
use DateTimeInterface;

/**
 * Class BaseMapper
 * @package Piggy\Api\Mappers
 */
abstract class BaseMapper
{
    /**
     * @param string $date
     * @return DateTime|false
     */
    public function parseDate(string $date)
    {
        return DateTime::createFromFormat(DateTimeInterface::ATOM, $date);
    }
}
