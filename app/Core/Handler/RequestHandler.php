<?php


namespace App\Core\Handler;

use App\Exceptions\ExceptionLogger;
use App\Http\Requests\BaseRequest;
use App\Core\Action\Results\ActionResult;
use App\Core\Action\Results\ActionError;
use App\Utils\ConfigHelper;
use Exception;
use Illuminate\Http\Request;

/**
 * Base handler class
 */
abstract class RequestHandler
{

    public function __construct(Request $request)
    {
        $this->request = $request;

        $this->user = $request->user();
        if (method_exists($this->request, 'validated')) {
            $this->input = $this->request->validated();
        } else {
            $this->input = $this->request->all();
        }
    }



    public function onError(Exception $ex): ActionResult
    {
        ExceptionLogger::reportException($ex);

        if (ConfigHelper::isLocal()) {
            dump($ex);
        }

        return new ActionError();
    }

    public abstract function handle(): ActionResult;
}
