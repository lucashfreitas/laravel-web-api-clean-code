<?php


namespace App\Features\Auth\Contracts;

use Illuminate\Http\Client\Request;

interface ILogoutHandler
{
    public function handle();
}
