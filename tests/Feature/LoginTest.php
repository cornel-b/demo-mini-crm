<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use DatabaseMigrations;

    public function testUserSeesCorrectErrorMessage()
    {
        $user = factory(User::class)->create();

        $this
            ->postJson('/login', [
                'email' => $user->email,
                'password' => 'incorrect',
            ])
            ->assertStatus(422)
            ->assertJsonFragment(['email' => ['These credentials do not match our records.']]);
    }

    public function testUserCanLogin()
    {
        $user = factory(User::class)->create();

        $this
            ->postJson('/login', [
                'email' => $user->email,
                'password' => 'password',
            ])
            ->assertStatus(204)
            ->assertSessionDoesntHaveErrors();
    }
}
