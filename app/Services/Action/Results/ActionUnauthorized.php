<?php



namespace App\Services\Action\Results;

use App\Http\Responses\BaseResponse;

class ActionUnauthorized extends ActionResult
{

    public function __construct(String $messsage)
    {
        $this->message = $messsage;
        $this->boot();
    }


    public function toResponse(): BaseResponse
    {
        $response = new BaseResponse();
        $response->success = false;
        $response->message = $this->message;

        return $response;
    }
}
