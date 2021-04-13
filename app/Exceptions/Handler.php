<?php

namespace App\Exceptions;

use App\Http\Responses\BaseResponse;
use App\Utils\ConfigHelper;
use \Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            if (ConfigHelper::isLive()) {
            }
        });
    }


    public function render($request, Throwable $e)
    {

        if (ConfigHelper::isLive()) {


            if ($e instanceof NotFoundHttpException) {
                return response()->json(['error' => 'Resource not Found.', 'success' => false], 404);
            } elseif ($e instanceof AuthorizationException) {
                return response()->json(['error' => 'Unauthorized.', 'success' => false], 403);
            } elseif ($e instanceof TokenMismatchException) {
                return response()->json(['error' => 'Unauthorized.', 'success' => false], 401);
            } elseif ($e instanceof ValidationException) {
                return BaseResponse::convertValidationExceptionToResponse($e, $request);
            } elseif ($e instanceof HttpException) {
                return response()->json(['error' => 'Unauthorized.', 'success' => false], 419);
            }
        }

        return parent::render($request, $e);
    }
}
