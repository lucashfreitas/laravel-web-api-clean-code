<?php


namespace App\Http\Requests;


class Testing
{
    public static $instance;


    public static $count;


    private function __construct()
    {
        if (!self::$instance) {
            self::$instance = 12;
        }
    }

    public function getInstance(): int
    {
        return self::$instance;
    }
}
