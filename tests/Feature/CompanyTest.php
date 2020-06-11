<?php

namespace Tests\Feature;

use App\Company;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class CompanyTest extends TestCase
{
    use DatabaseMigrations;
    public $user;
    public $company;

    const ENDPOINT = '/companies';

    public function setUp(): void
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
        $this->company = factory(Company::class)->create();
    }

    public function testOnlyAuthenticatedUsersCanCreateCompanies()
    {
        $this
            ->postJson(self::ENDPOINT, [])
            ->assertStatus(401);
    }

    public function testNameIsRequired()
    {
        $this
            ->actingAs($this->user)
            ->postJson(self::ENDPOINT)
            ->assertStatus(422)
            ->assertJsonFragment(['name' => ['The name field is required.']]);
    }

    public function testLogoHasCorrectSize()
    {
        $logo = UploadedFile::fake()->image('avatar.jpg', 50, 50);

        $this
            ->actingAs($this->user)
            ->postJson(self::ENDPOINT, ['logo' => $logo])
            ->assertStatus(422)
            ->assertJsonFragment(['logo' => ['The logo has invalid image dimensions.']]);
    }

    public function testACompanyCanBeCreated()
    {
        $companyData = [
            'name' => 'ACME INC',
        ];

        $this
            ->actingAs($this->user)
            ->postJson(self::ENDPOINT, $companyData)
            ->assertStatus(302);

        $this->assertDatabaseHas('companies', [
            'name' => $companyData['name'],
        ]);
    }

}
