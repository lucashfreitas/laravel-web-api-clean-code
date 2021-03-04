<?php


namespace App\Services\Action\Results;

use App\Http\Responses\BaseResponse;

abstract class ActionResult
{

    protected $data;
    protected $errors;
    protected $message;
    protected $exception;
    protected $success;
    protected $code;


    public function boot()
    {
    }


    protected abstract function toResponse(): BaseResponse;
}
