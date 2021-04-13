<?php


namespace App\Core\Action;

use App\Http\Responses\BaseResponse;
use App\Core\Handler\RequestHandler;
use App\Core\Action\Results\ActionUnauthorized;
use App\Core\Action\Results\ActionResult;
use App\Core\Action\Results\ActionDomainValidation;
use App\Core\Action\Results\ActionForbidden;
use App\Core\Action\Results\ActionError;
use App\Core\Action\Results\ActionSuccess;
use Exception;
use Illuminate\Http\Request;

/**
 * Executes the action and returns a api base response
 */
class ActionHandler
{



    protected static function generateResponseFromAction(ActionResult $result)
    {

        if ($result instanceof ActionSuccess) {
            return BaseResponse::ok($result->toResponse());
        } else if ($result instanceof ActionError) {
            return BaseResponse::error($result->toResponse());
        } else if ($result instanceof ActionForbidden) {
            return BaseResponse::forbidden($result->toResponse());
        } else if ($result instanceof ActionDomainValidation) {
            return BaseResponse::badRequest($result->toResponse());
        } else if ($result instanceof ActionUnauthorized) {
            return BaseResponse::unauthorized($result->toResponse());
        }

        return  BaseResponse::defaultError();
    }


    public static function execute(RequestHandler $handler, Request $request): \Illuminate\Http\JsonResponse
    {
        $result = null;
        /*
        if in the future we need to use different implementations then makes sense to retrive the handler from container
        $handler = App::makeWith($handler, ['request' => $request]);

        */
        if (!$handler) {
            throw new Exception("Handler $handler was not found in the service container");
        }
        try {
            $result = $handler->handle($request);
        } catch (Exception $ex) {
            $result =  $handler->onError($ex);
        }

        return self::generateResponseFromAction($result);
    }
}
