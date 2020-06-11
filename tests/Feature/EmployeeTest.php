<?php

namespace Tests\Feature;

use App\Company;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class EmployeeTest extends TestCase
{
    use DatabaseMigrations;
    public $user;
    public $company;

    const ENDPOINT = '/employees';

    public function setUp(): void
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
        $this->company = factory(Company::class)->create();
    }

    public function testOnlyAuthenticatedUsersCanCreateEmployees()
    {
        $this
            ->postJson(self::ENDPOINT, [])
            ->assertStatus(401);
    }

    public function testFirstNameIsRequired()
    {
        $this
            ->actingAs($this->user)
            ->postJson(self::ENDPOINT)
            ->assertStatus(422)
            ->assertJsonFragment(['first_name' => ['The first name field is required.']]);
    }

    public function testLastNameIsRequired()
    {
        $this
            ->actingAs($this->user)
            ->postJson(self::ENDPOINT, [])
            ->assertStatus(422)
            ->assertJsonFragment(['last_name' => ['The last name field is required.']]);
    }

    public function testEmailFieldIsRequired()
    {
        $employeeData = [
            'email' => 'invalid',
        ];

        $this
            ->actingAs($this->user)
            ->postJson(self::ENDPOINT, $employeeData)
            ->assertStatus(422)
            ->assertJsonFragment(['email' => ['The email must be a valid email address.']]);
    }

    public function testAnEmployeeCanBeCreated()
    {
        $employeeData = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'test@test.com',
            'company_id' => $this->company->id,
        ];

        $this
            ->actingAs($this->user)
            ->postJson(self::ENDPOINT, $employeeData)
            ->assertStatus(302);

        $this->assertDatabaseHas('employees', [
            'email' => $employeeData['email'],
        ]);

    }

}
