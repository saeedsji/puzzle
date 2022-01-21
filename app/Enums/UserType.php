<?php

namespace App\Enums;

use BenSampo\Enum\Enum;


final class UserType extends Enum
{
    const normal = 1;
    const admin = 2;
    
    public static function get($value)
    {
        switch ($value) {
            case self::normal:
                return 'کابر عادی';
                break;
            case self::admin:
                return 'ادمین';
                break;
        }
    }
    
    public static function getHtml($value)
    {
        switch ($value) {
            case self::normal:
                return "<span class='badge badge-success'>کاربر عادی</span>";
                break;
            case self::admin:
                return "<span class='badge badge-danger'>ادمین</span>";
                break;
            default:
                return self::getKey($value);
        }
    }
}
