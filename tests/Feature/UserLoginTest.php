<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Etablissement;
use App\Service;

class UserLoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_logged_in_user_is_redirected_to_home()
    {
        $user = factory(User::class)->make();

        $response = $this->actingAs($user)->get('/login');

        $response->assertRedirect('/home');
    }

    /** @test */
    public function test_user_can_login_with_correct_credentials()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt($password = 'i-love-laravel'),
        ]);

        $response = $this->post('/login', [
            'email'    => $user->email,
            'password' => $password,
        ]);

        $response->assertRedirect('/home');
        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function test_user_cannot_login_with_incorrect_password()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt('i-love-laravel'),
        ]);

        $response = $this->from('/login')->post('/login', [
            'email'    => $user->email,
            'password' => 'invalid-password',
        ]);

        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('email');
        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();
    }

    /** @test */
    public function a_guest_user_cannot_access_protected_pages()
    {
        $routes = [
            '/home',
            '/etablissements',
            '/etablissement/100',
            '/service/100',
            '/user/service',
            '/user/etablissement',
            '/user/etablissement/100/edit',
            '/admin',
            '/admin/etablissement/create',
            '/admin/etablissement/edit/100',
            '/admin/etablissement/100/invite',
        ];

        foreach ($routes as $route) {
            $response = $this->get($route);
            $response->assertRedirect('/login');
        }
    }

    /** @test */
    public function a_guest_user_cannot_post_to_protected_pages()
    {
        $routes = [
            '/user/service',
            '/etablissement/service',
            '/invite',
            '/admin/etablissement/store',
            // '/register',
            // '/finalize',
            // '/interested',
        ];

        foreach ($routes as $route) {
            $response = $this->post($route);
            $response->assertRedirect('/login');
        }
    }
}
