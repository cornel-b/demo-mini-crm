<?php

namespace Tests\Browser;

use Tests\DuskTestCase;

class EmployeesTest extends DuskTestCase
{
    const BASE_URL = 'http://127.0.0.1:8000';

    public function setUp(): void
    {
        parent::setUp();
        $this->browse(function ($browser) {
            $browser->visit(self::BASE_URL . '/login')
                ->type('email', 'admin@admin.com')
                ->type('password', 'password')
                ->press('Sign In');
        });
    }


    public function testUserCanSeeEmployeesPage()
    {
        $this->browse(function ($browser) {
            $browser
                ->visit(self::BASE_URL . '/employees')
                ->assertSee('Manage Employees');
        });
    }

}
