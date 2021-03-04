<?php


namespace App\Exceptions;

use App\Utils\ConfigHelper;

class ExceptionLogger
{
    public static function reportException($exception, $description = null, $metadata = null, $critical = false, $trace = null)
    {
        if (ConfigHelper::isLocal()) {
            dump($exception);
        }
        throw $exception;
    }
}
