<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_new_users_can_register(): void
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'username' => 'testuser',
            'email' => 'test@example.com',
            'role' => 'student',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertAuthenticated();
        $user = \App\Models\User::where('email', 'test@example.com')->first();
        if ($user && $user->isStudent()) {
            $response->assertRedirect(route('student.dashboard', absolute: false));
        } elseif ($user && $user->isTeacher()) {
            $response->assertRedirect(route('teacher.dashboard', absolute: false));
        } else {
            $response->assertRedirect(route('dashboard', absolute: false));
        }
    }
}
