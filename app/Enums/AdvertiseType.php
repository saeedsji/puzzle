<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class AdvertiseType extends Enum
{
    const normal = 1;
    const instant = 2;
    const offer = 3;
    
    public static function get($value)
    {
        switch ($value)
        {
            case self::normal:
                return 'عادی';
                break;
            case self::instant:
                return 'فوری';
                break;
            case self::offer:
                return 'پیشنهادی';
                break;
        }
    }
    
}
