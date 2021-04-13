<?php


namespace App\Core\Action;

use App\Core\Action\Results\ActionDomainValidation;
use App\Core\Action\Results\ActionSuccess;
use App\Core\Action\Results\ActionError;
use App\Core\Action\Results\ActionForbidden;
use App\Core\Action\Results\ActionUnauthorized;
use Exception;
use Illuminate\Http\Request;

class ActionFactory
{

    /**
     * @method static \App\Services\Action\Results\ActionResult  unauthorized(string )
     * @method static \App\Services\Action\Results\ActionResult  forbidden(object $data, string $message)
     * @method static \App\Services\Action\Results\ActionResult  error(Exception $exception)
     * @method static \App\Services\Action\Results\ActionResult  success(Exception $exception)
     * @method static \App\Services\Action\Results\ActionResult  domainValidation(string $message, object $data)
   
     * @see \App\Services\ActionResult\ActionHandler
     */


    public static function domainValidation($message = '', $data = null)
    {
        return new ActionDomainValidation($message, $data,);
    }

    public static function success($data = null, $message = '')
    {
        return new ActionSuccess($data, $message);
    }

    public static function error(Exception $exception)
    {
        return new ActionError($exception);
    }

    public static function forbidden($data = null, $message = '')
    {
        return new ActionForbidden($data, $message);
    }

    public static function unauthorized(string $messsage)
    {
        return new ActionUnauthorized($messsage);
    }
}
