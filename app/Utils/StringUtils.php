<?php


namespace App\Utils;




class StringUtils
{


    public static function isNullOrEmpty($value)
    {
        return self::isNull($value) || self::isEmpty($value);
    }


    public static function isNull($value)
    {

        return !isset($value);
    }

    public static function isEmpty($value)
    {
        return self::isNull($value) || strlen($value) === 0;
    }
}
