<?php

namespace App\Enums;

use BenSampo\Enum\Enum;


final class SliderStatus extends Enum
{
    const active =   1;
    const deactive = 2;

    public static function get($value)
    {
        switch ($value) {
            case self::active:
                return 'فعال';
                break;
            case self::deactive:
                return 'غیر فعال';
                break;

            default:
                return self::getKey($value);
        }
    }

    public static function getHtml($value)
    {
        switch ($value) {
            case self::active:
                return "<span class='badge badge-success'>فعال</span>";
                break;
            case self::deactive:
                return "<span class='badge badge-danger'>غیر فعال</span>";
                break;

            default:
                return self::getKey($value);
        }
    }
}
