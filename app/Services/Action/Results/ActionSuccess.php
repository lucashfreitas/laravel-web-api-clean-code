<?php



namespace App\Services\Action\Results;

use App\Http\Responses\BaseResponse;

class ActionSuccess extends ActionResult
{

    public function __construct($data = null, $message = '')
    {
        $this->data = $data;
        $this->success = true;
        $this->message = $message;
        $this->boot();
    }

    public function toResponse(): BaseResponse
    {
        $response = new BaseResponse();
        $response->success = $this->success;
        $response->data = $this->data;
        $response->errors =  [];
        $response->message = $this->message;

        return $response;
    }
}
