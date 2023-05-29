<?php

namespace Tests\Feature;

use App\Modules\Usuarios\Usuarios\User;
use App\Services\GoogleService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\UserService;
use Mockery\MockInterface;
use Tests\Helpers\ApiHelper;
use Tests\TestCase;

class LoginGoogleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test login.
     *
     * @return void
     */
    public function testLoginSuccess()
    {
        $userGoogle = new \Laravel\Socialite\Two\User();
        $userGoogle->map([
            'nickname' => 'mi_usuario',
            'name' => 'John Wayne',
            'email' => 'mi_usuario@gmail.com',
            'id' => '1234'
        ]);

        $XGooToken = 'asdasfwfqffqfq';

        $this->mock(GoogleService::class, function(MockInterface $mock) use ($userGoogle, $XGooToken) {
            $mock->shouldReceive('login')
                ->with($XGooToken)
                ->once()
                ->andReturn($userGoogle);
        });

        $this->mock(UserService::class, function(MockInterface $mock) use ($userGoogle) {
            $mock->shouldReceive('getByEmail')
                ->with($userGoogle->email)
                ->once()
                ->andReturn(null);

            $mock->shouldReceive('create')
                ->with($userGoogle->getRaw())
                ->once()
                ->andReturn(new User([
                    'email' => 'mi_usuario@gmail.com',
                    'nombre' => 'John',
                    'apellido' => 'Wayne',
                ]));
        });

        $response = $this->post(ApiHelper::buildUrlFor('auth:google'), [
            'email' => 'mi_usuario@gmail.com',
            'token' => '123456789abcdefg'
        ]);

        $response->assertJsonStructure([
            'access_token',
            'token_type',
            'expires_at',
            'me'
        ]);
        $response->assertStatus(200);
    }

    /**
     * A basic test logout.
     *
     * @return void
     */
    public function testLogout()
    {
        $response = $this->actingAs(new User())->post(ApiHelper::buildUrlFor('auth:logout'));

        $response->assertStatus(200);
    }

    /**
     * Basic test loguout without any auth
     *
     * @return void
     */
    public function testLogoutWithoutAuth()
    {
        $response = $this->post(ApiHelper::buildUrlFor('auth:logout'));

        $response->assertStatus(403);
    }
}
