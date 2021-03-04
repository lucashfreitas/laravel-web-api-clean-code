<?php

use Tests\CreatesApplication;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;

class LogoutTest extends TestCase
{
    use CreatesApplication, WithFaker;

    /**
     * Auth Service Spy.
     *
     * @var \Mockery\MockInterface
     */
    protected $authSevice;

    protected const LOGOUT_ROUTE = '/api/auth/logout';
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function setUp(): void
    {

        parent::setUp();
        $this->setUpFaker();
        $this->withoutExceptionHandling();
    }
    /** @test */

    public function shouldNotExecuteIfUserIsNotLogged()
    {
        $this->assertFalse(Auth::check());
        $this->createUser();
        $response =  $this->postJson(LogoutTest::LOGOUT_ROUTE);
        $response->assertStatus(200);
    }
    /** @test */
    public function shouldLogout()
    {
        $this->assertFalse(Auth::check());
        $this->createUser(true);
        $this->assertTrue(Auth::check());
        //asset user is logged
        $this->assertTrue(Auth::check());
        //user should logout
        $response =  $this->postJson(LogoutTest::LOGOUT_ROUTE);
        $response->assertStatus(200);
        $this->assertFalse(Auth::check());
    }
}
