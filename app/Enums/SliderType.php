<?php

namespace App\Enums;

use BenSampo\Enum\Enum;


final class SliderType extends Enum
{
    const advertise = 1;
    const screen = 2;
    const link = 3;
    
    public static function get($value)
    {
        switch ($value)
        {
            case self::advertise:
                return 'آگهی';
                break;
            case self::screen:
                return 'صفحه اپلیکیشن';
                break;
            case self::link:
                return 'لینک';
                break;
            default:
                return self::getKey($value);
        }
    }
    
    
}
