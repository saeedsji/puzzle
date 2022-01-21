<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class SliderPosition extends Enum
{
    const main = 1;
    public static function get($value)
    {
        switch ($value)
        {
            case self::main:
                return 'صفحه اصلی';
                break;
            default:
                return self::getKey($value);
        }
    }
}
