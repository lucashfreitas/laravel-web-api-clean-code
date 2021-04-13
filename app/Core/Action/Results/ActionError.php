<?php



namespace App\Core\Action\Results;

use App\Http\Responses\BaseResponse;
use Exception;
use Illuminate\Support\Facades\Log;

class ActionError extends ActionResult
{

    public function __construct($message = "")
    {
        $this->message = $message || __("general.unexpected:error");
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
