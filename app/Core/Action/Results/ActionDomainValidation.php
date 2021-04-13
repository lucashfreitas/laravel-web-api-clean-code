<?php



namespace App\Core\Action\Results;

use App\Http\Responses\BaseResponse;
use Exception;
use Illuminate\Support\Facades\Log;

/**
 * Business roles validation
 */
class ActionDomainValidation extends ActionResult
{

    public function __construct(String $message, $data = null)
    {
        $this->message = $message;
        $this->data = $data;
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
