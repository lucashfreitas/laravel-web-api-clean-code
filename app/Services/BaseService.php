<?php

namespace App\Services;

use App\Services\Action\Results\ActionHandler;

class BaseService
{

    /**
     * The event listener mappings for the application.
     *
     * @var \App\Services\ActionResult\ActionHandler
     */
    protected $handler;

    public function __construct()
    {
        $this->handler = null;
    }
}
