<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Testing\TestResponse;

abstract class TestCase extends BaseTestCase
{

    use CreatesApplication;
    /**
     * Creates the user 
     */
    protected function createUser($authenticated = false): User
    {

        $user = User::factory()->create();

        if ($authenticated) {
            $this->actingAs($user);
        }

        return $user;
    }


    protected function extractCookie(TestResponse $response, String $cookieName)
    {

        $cookies = $response->headers->getCookies();

        $findCookie = array_filter($cookies, function ($c) use ($cookieName) {

            return $c->getName() === $cookieName;
        });

        return  array_shift($findCookie)->getValue();
    }
}
