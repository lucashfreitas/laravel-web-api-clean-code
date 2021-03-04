<?php

namespace App\Utils;


class ConfigHelper
{
    private function __construct()
    {
    }



    public static function isLocal()
    {
        if (config('app.env') === 'local') {
            return true;
        } else {
            return false;
        }
    }
    /*ENVIRONMENT SETTINGS*/
    public static function isLive()
    {
        if (config('app.env') === 'LIVE') {
            return true;
        } else {
            return false;
        }
    }
}
