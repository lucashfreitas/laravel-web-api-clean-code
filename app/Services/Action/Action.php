<?php


namespace App\Services\Action;

use App\Exceptions\ExceptionLogger;
use App\Services\Action\Results\ActionResult;
use App\Services\Action\Results\ActionError;
use App\Utils\ConfigHelper;
use Exception;
use Illuminate\Http\Request;

abstract class Action
{


    public $id;



    public $request;
    /** @var \App\Models\User|null */
    public $user;
    /** @var \App\Models\User|null */
    public $input;


    protected function setRequestInput()
    {

        if (method_exists($this->request, 'validated')) {
            $this->input = $this->request->validated();
        } else {
            $this->input = $this->request->all();
        }
    }



    public final function __construct(Request $request)
    {
        $this->request = $request;

        $this->user = $request->user();
        $this->setRequestInput();
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
