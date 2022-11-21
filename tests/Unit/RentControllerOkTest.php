<?php

use App\Models\Car;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\CreatesApplication;
use Tests\TestCase;

class RentControllerOkTest extends TestCase
{
    use CreatesApplication, DatabaseMigrations;

    public function testRent()
    {
        $this->createAuthenticatedUser();

        /** @var Car $car */
        $car = Car::factory()->create();

        $response = $this->getJson('api/car/rent/' . $car->id);

        $response->assertJsonPath('name', $car->name);
        $response->assertJsonPath('auto_number', $car->auto_number);
        $response->assertJsonPath('rented', true);
        $response->assertOk();
    }

    public function testFinishRent()
    {
        $this->createAuthenticatedUser();

        /** @var Car $car */
        $car = Car::factory()->create();

        $this->getJson('api/car/rent/' . $car->id);

        $response = $this->getJson('api/car/finishRent/' . $car->id);

        $response->assertJsonPath('name', $car->name);
        $response->assertJsonPath('auto_number', $car->auto_number);
        $response->assertJsonPath('rented', false);

        $response->assertOk();
    }

}
