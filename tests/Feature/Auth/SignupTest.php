<?php

use App\Features\Auth\Events\UserRegistered;
use App\Events\UserLoggedEvent;
use App\Features\Auth\Listeners\OnUserRegistered;
use App\Features\Auth\Listeners\OnUserSuccessfulLogin;
use Tests\CreatesApplication;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Testing\WithFaker;

class SignupTest extends TestCase
{

    protected const SIGN_UP_ROUTE = '/api/auth/signup';
    protected $onUserRegisteredHandler;

    use CreatesApplication, WithFaker;
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->onUserRegisteredHandler = $this->spy(OnUserRegistered::class);
        $this->setUpFaker();
    }


    /** @test */
    public function shouldNotAcceptRequestWithoutParameters()
    {
        $response =  $this->postJson(SignupTest::SIGN_UP_ROUTE);
        $response->assertStatus(422);
    }

    /** @test */
    public function shouldNotAllowInvalidInput()
    {

        $invalidEmail = $this->createSingupRequestStub();
        $invalidPassword = $this->createSingupRequestStub();
        $invalidFirstName = $this->createSingupRequestStub();
        $invalidLastName  = $this->createSingupRequestStub();

        $invalidEmail['email'] = $this->faker->lexify(str_repeat('?', 6));
        $invalidPassword['password'] = $this->faker->lexify(str_repeat('?', 5));
        $invalidFirstName['first_name'] = '';
        $invalidLastName['last_name'] = '';

        $response = $this->postJson(SignupTest::SIGN_UP_ROUTE, $invalidEmail);
        $response->assertStatus(422);

        $response = $this->postJson(SignupTest::SIGN_UP_ROUTE, $invalidPassword);
        $response->assertStatus(422);

        $response = $this->postJson(SignupTest::SIGN_UP_ROUTE, $invalidFirstName);
        $response->assertStatus(422);

        $response = $this->postJson(SignupTest::SIGN_UP_ROUTE, $invalidLastName);
        $response->assertStatus(422);
    }



    /** @test */
    public function shouldCreateUserAndDispatchEvents()
    {
        Event::fake();
        $data = $this->createSingupRequestStub();
        $response  = $this->postJson(SignupTest::SIGN_UP_ROUTE, $data);
        $response->assertStatus(200);
        Event::assertDispatched(UserRegistered::class);
    }


    /** @test */
    public function shouldNotAllowDuplicatedEmails()
    {
        $user = $this->createUser();
        $data = $this->createSingupRequestStub();
        $data['email'] = $user->email;
        $response  = $this->postJson(SignupTest::SIGN_UP_ROUTE, $data);
        $response->assertStatus(400);
    }


    private function createSingupRequestStub()
    {
        $data = [
            "email" => $this->faker->email(),
            "password" => $this->faker->lexify(str_repeat('?', 6)),
            "first_name" => $this->faker->firstName(),
            "last_name" => $this->faker->lastName(),
        ];


        return $data;
    }
}
