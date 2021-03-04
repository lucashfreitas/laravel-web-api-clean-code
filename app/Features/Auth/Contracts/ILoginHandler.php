<?php


namespace App\Features\Auth\Contracts;

use Illuminate\Http\Client\Request;

interface ILoginHandler
{
    public function handle();
}
