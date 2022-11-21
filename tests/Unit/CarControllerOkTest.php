<?php

use App\Models\Car;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\CreatesApplication;
use Tests\TestCase;

class CarControllerOkTest extends TestCase
{
    use CreatesApplication, DatabaseMigrations;

    public function testIndex()
    {
        $this->createAuthenticatedUser();
        $car = Car::factory()->create();

        $response = $this->getJson('api/car/index');

        $response->assertOk();
    }

    public function testShow()
    {

    }
}
