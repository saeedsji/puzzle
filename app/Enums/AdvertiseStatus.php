<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class AdvertiseStatus extends Enum
{
    const waiting = 1;
    const published = 2;
    const reject = 3;
    const deleted = 4;
    
    public static function get($value)
    {
        switch ($value)
        {
            case self::waiting:
                return 'در حال بررسی';
                break;
            case self::published:
                return 'منتشر شده';
                break;
            case self::reject:
                return 'رد شده';
                break;
            case self::deleted:
                return 'حذف شده';
                break;
        }
    }
    
    public static function getHtml($value)
    {
        switch ($value)
        {
            case self::waiting:
                return "<span class='badge badge-warning'>در حال بررسی</span>";
                break;
            case self::published:
                return "<span class='badge badge-success'>منتشر شده</span>";
                break;
            case self::reject:
                return "<span class='badge badge-danger'>رد شده</span>";
                break;
            case self::deleted:
                return "<span class='badge badge-danger'>حذف شده</span>";
                break;
            default:
                return self::getKey($value);
        }
    }
    
    public static function color($value)
    {
        switch ($value)
        {
            case self::waiting:
                return '#f39c12';
                break;
            case self::published:
                return '#27ae60';
                break;
            case self::reject:
                return '#e74c3c';
                break;
            case self::deleted:
                return '#c0392b';
                break;
        }
    }
    
}
