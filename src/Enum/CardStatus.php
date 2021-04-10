<?php

namespace Piggy\Api\Enum;

use MyCLabs\Enum\Enum;

/**
 * Class CardStatus
 *
 * @package App\Piggy\Enum
 */
class CardStatus extends Enum
{
    const INACTIVE = 0;
    const ACTIVE = 1;
    const DISABLED = 2;
}
