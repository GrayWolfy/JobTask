<?php

use App\Models\Car;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\CreatesApplication;
use Tests\TestCase;

class CarControllerFailTest extends TestCase
{
    use CreatesApplication, DatabaseMigrations;

    public function testIndex()
    {
        $response = $this->getJson('api/car/index');
        $response->assertUnauthorized();
    }

    public function testShow()
    {
        $this->createAuthenticatedUser();

        $response = $this->getJson('api/car/98');

        $response->assertNotFound();
    }
}
