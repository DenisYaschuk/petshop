<?php

namespace Tests\Feature;

use App\Providers\RouteServiceProvider;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function test_login_screen_can_be_rendered()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_users_can_authenticate_using_the_login_screen()
    {
        $response = $this->post('/login', [
            'email' => 'admin@admin.com',
            'password' => 'admin123',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }

    public function test_users_can_not_authenticate_with_invalid_password()
    {
        $this->post('/login', [
            'email' => 'admin@admin.com',
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }
}
