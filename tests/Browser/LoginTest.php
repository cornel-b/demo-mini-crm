<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    const BASE_URL = 'http://127.0.0.1:8000';

    public function testUserCanSeeHomePage()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(self::BASE_URL . '/')
                ->assertSee(config('app.name'))
                ->assertSeeLink('Login');
        });
    }

    public function testUserCanLogin()
    {
        $this->browse(function ($browser) {
            $browser->visit(self::BASE_URL . '/login')
                ->type('email', 'admin@admin.com')
                ->type('password', 'password')
                ->press('Sign In')
                ->assertPathIs('/home');
        });
    }

}
