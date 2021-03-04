<?php

use App\Events\UserLoggedEvent;
use App\Features\Auth\Contracts\ILoginHandler;
use App\Features\Auth\Handlers\LoginHandler;
use App\Http\Responses\BaseResponse;
use App\Listeners\Auth\OnUserSuccessfulLogin;
use Tests\CreatesApplication;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Auth\Events\Authenticated;
use Illuminate\Auth\Events\Failed;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Tests\TestUtils;

class LoginTest extends TestCase
{
    use CreatesApplication, WithFaker;

    /** @var \Illuminate\Foundation\Testing\Concerns\InteractsWithContainer::spy */
    protected $handlerSpy;


    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function setUp(): void
    {

        parent::setUp();
        $this->handlerSpy = $this->spy(ILoginHandler::class);
        $this->setUpFaker();
    }
    /** @test */
    public function shouldNotAcceptRequestWithoutParametersTest()
    {
        $response =  $this->postJson('/api/auth/login');
        $response->assertStatus(422);
    }
    /** @test */
    public function shouldNotAllowInvalidEmails()
    {
        $data = [
            "email" => $this->faker->lexify(str_repeat('?', 30)),
            "password" => $this->faker->lexify(str_repeat('?', 6)),
        ];
        $response = $this->postJson('/api/auth/login', $data);
        $response->assertStatus(422);
    }
    /** @test */
    public function shouldNotAllowInvalidPassword()
    {
        $data = [
            "email" => "terst@test.com",
            "password" => $this->faker->lexify(str_repeat('?', 5)),
        ];
        $response = $this->postJson('/api/auth/login', $data);
        $response->assertStatus(422);
    }

    /** @test */
    public function shouldNotAllowInvalidLoginAndDispatchEvents()
    {
        Event::fake();
        $data = [
            "email" => "test@test.com",
            "password" => "123456",
        ];

        $response = $this->postJson('/api/auth/login', $data);
        $response->assertStatus(401);

        Event::assertDispatched(Failed::class);
    }
    /** @test */
    public function shouldAcceptLoginAttemptAndDispatchEvents()
    {

        Event::fake();
        $user = $this->createUser();
        $data = [
            "email" =>   $user->email,
            "password" => "123456",
        ];

        $response = $this->postJson('/api/auth/login', $data);
        $response->assertStatus(200);
        Event::assertDispatched(Login::class);
    }

    /** @test */
    public function shouldCreateSanctumCookies()
    {

        $response = $this->getJson('/sanctum/csrf-cookie');
        $this->assertCount(2, $response->headers->getCookies());
        $xsrfCookie = $this->extractCookie($response, "XSRF-TOKEN");
        $sessionCookie = $this->extractCookie($response, Config::get('session.cookie'));
        //assertcookie not empty
        $this->assertNotEmpty($sessionCookie);
        $this->assertNotEmpty($xsrfCookie);
        $response->assertStatus(204);
        $response->assertCookie("XSRF-TOKEN");
        $response->assertCookie(Config::get('session.cookie'));
    }

    /** @test */
    public function shouldLoginAndBeAuthenticatedUntilTokenExpires()
    {

        $user = $this->createUser();
        $data = [
            'email' =>   $user->email,
            'password' => "123456",
        ];

        $loginResponse = $this->postJson('/api/auth/login', $data);
        $loginResponse->assertStatus(200);

        $meResponse = $this->getJson('/api/auth/me');
        $meResponse->assertStatus(200);
        $meResponse->assertJson([
            'data' => [
                'email' => $user->email,
                'id' => $user->id
            ]
        ]);
    }


    /** @test */
    public function shouldNotAccessUserPrivateRoute()
    {

        $user = $this->createUser();
        $meResponse = $this->getJson('/api/auth/me');
        $meResponse->assertStatus(401);
    }
}
