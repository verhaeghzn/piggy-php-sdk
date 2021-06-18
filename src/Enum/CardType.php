<?php

namespace Piggy\Api\Enum;

use MabeEnum\Enum;

/**
 * Class CardType
 * @package Piggy\Api\Enum
 */
class CardType extends Enum
{
    const PHYSICAL = 1;
    const MOBILE = 2;
    const WEB = 3;
}