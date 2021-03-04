<?php

namespace App\Http\Responses;

use \Illuminate\Validation\ValidationException;

class BaseResponse
{


    public $success;
    public $errors;
    public $data;
    public $message;


    const VALIDATION_ERROR_CODE = 'fail-validation';


    public static function defaultSuccess()
    {

        $response = new BaseResponse();
        $response->success = true;
        return self::error($response);
    }


    public static function defaultError()
    {

        $response = new BaseResponse();
        $response->success = false;
        $response->message = __("general.unexpected:error");
        $response->data = null;
        return self::error($response);
    }

    public static function ok(BaseResponse $response)
    {
        return response()->json($response, 200);
    }

    public static function badRequest(BaseResponse $response)
    {
        return response()->json($response, 400);
    }

    public static function unProcessableEntity(BaseResponse $response)
    {
        return response()->json($response, 422);
    }

    public static function unauthorized(BaseResponse $response)
    {
        return response()->json($response, 401);
    }

    public static function forbidden(BaseResponse $response)
    {
        return response()->json($response, 401);
    }




    public static function error(BaseResponse $response)
    {
        return response()->json($response, 500);
    }


    public static function convertValidationExceptionToResponse(ValidationException $e, $request)
    {
        $response = new BaseResponse();
        $response->success = false;
        $response->error = BaseResponse::VALIDATION_ERROR_CODE;
        $response->message = $e->getMessage();
        $response->data = $e->errors();

        return self::unProcessableEntity($response);
    }
}
