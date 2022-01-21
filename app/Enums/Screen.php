<?php

namespace App\Enums;

use BenSampo\Enum\Enum;


final class Screen extends Enum
{
    const main = 1;
    const meditation = 2;
    const plan = 3;
    const editProfile = 4;
    const download = 5;
    const video = 6;
    const blog = 7;
    const aboutUs = 8;
    const faq = 9;
    const notification = 10;
    const lastseen = 11;
    const bookmark = 12;
    const breath = 13;
    const ticket = 14;
    
    
    public static function get($value)
    {
        switch ($value) {
            case self::main:
                return 'صفحه اصلی';
                break;
            case self::meditation:
                return 'مدیتیشن';
                break;
            case self::plan:
                return 'ارتقا عضویت';
                break;
            case self::editProfile:
                return 'ویرایش پروفایل';
                break;
            case self::download:
                return 'دانلود های من';
                break;
            case self::video:
                return 'آموزش های ویدیویی';
                break;
            case self::aboutUs:
                return 'درباره ما';
                break;
            case self::faq:
                return 'سوالات متداول';
                break;
            case self::notification:
                return 'اعلان ها';
                break;
            case self::lastseen:
                return 'آخرین مشاهده ها';
                break;
            case self::bookmark:
                return 'نشان شده ها';
                break;
            case self::breath:
                return 'تمرین تنفس';
                break;
            case self::ticket:
                return 'پشتیبانی';
                break;
            default:
                return self::getKey($value);
        }
    }
}
