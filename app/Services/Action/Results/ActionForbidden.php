<?php



namespace App\Services\Action\Results;

use App\Http\Responses\BaseResponse;

class ActionForbidden extends ActionResult
{

    public function __construct($data = null, $message = '')
    {
        $this->data = $data;
        $this->message = $message;
        $this->boot();
    }

    public function toResponse(): BaseResponse
    {
        $response = new BaseResponse();
        $response->success = false;
        $response->data = $this->data;
        $response->errors =  [];
        $response->message = $this->message;

        return $response;
    }
}
