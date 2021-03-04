<?php


use Tests\CreatesApplication;
use Tests\TestCase;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Config;

class MeTest extends TestCase
{
    use CreatesApplication, WithFaker;



    protected const ME_ROUTE = '/api/auth/me';

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->setUpFaker();
    }
    /** @test */
    public function shouldNotAllowUnauthenticatedRequest()
    {
        $response =  $this->getJson(MeTest::ME_ROUTE);
        $response->assertStatus(401);
    }


    /** @test */
    public function shouldReturnAuthenticatedUser()
    {
        //creates user authentiucated
        $user = $this->createUser(true);
        $meResponse = $this->getJson(MeTest::ME_ROUTE);
        $meResponse->assertStatus(200);
        $meResponse->assertJson([
            'data' => [
                'email' => $user->email,
                'id' => $user->id
            ]
        ]);
    }
}
