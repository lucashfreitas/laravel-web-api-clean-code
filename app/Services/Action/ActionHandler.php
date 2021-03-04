<?php


namespace App\Services\Action;

use App\Http\Responses\BaseResponse;
use App\Services\Action\Results\ActionUnauthorized;
use App\Services\Action\Results\ActionResult;
use App\Services\Action\Results\ActionDomainValidation;
use App\Services\Action\Results\ActionForbidden;
use App\Services\Action\Results\ActionError;
use App\Services\Action\Results\ActionSuccess;
use App\Utils\ConfigHelper;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;

class ActionHandler
{



    protected function generateResponseFromAction(ActionResult $result)
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


    public function execute(string $handler, Request $request): \Illuminate\Http\JsonResponse
    {
        $result = null;
        $handler = App::makeWith($handler, ['request' => $request]);

        if (!$handler) {
            throw new Exception("Service $handler was not found in the service container");
        }
        try {
            $result = $handler->handle();
        } catch (Exception $ex) {
            $result =  $handler->onError($ex);
        }

        return $this->generateResponseFromAction($result);
    }
}
