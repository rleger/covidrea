<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BasicNavigationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function the_home_page_returns_200()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /** @test */
    public function the_press_page_returns_200()
    {
        $response = $this->get('/presse');

        $response->assertStatus(200);
    }

    /** @test */
    public function a_user_can_access_login_page()
    {
        $response = $this->get('/login');

        $response->assertSuccessful();
        $response->assertViewIs('auth.login');
    }
}
