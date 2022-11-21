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

        /** @var Car $car */
        $car = Car::factory()->create();

        $response = $this->getJson('api/car/index');

        $response->assertJsonPath('data.4.id', $car->id);
        $response->assertJsonPath('data.4.name', $car->name);
        $response->assertJsonPath('data.4.auto_number', $car->auto_number);
        $response->assertJsonPath('data.4.rented', (int)$car->rented);
        $response->assertJsonPath('data.4.rented_begin', $car->rented_begin);
        $response->assertJsonPath('data.4.rented_end', $car->rented_end);


        $response->assertOk();
    }

    public function testShow()
    {
        $this->createAuthenticatedUser();

        /** @var Car $car */
        $car = Car::factory()->create();

        $response = $this->getJson('api/car/' . $car->id);

        $response->assertJsonPath('name', $car->name);
        $response->assertJsonPath('auto_number', $car->auto_number);
        $response->assertJsonPath('rented', (int)$car->rented);
        $response->assertJsonPath('rented_begin', $car->rented_begin);
        $response->assertJsonPath('rented_end', $car->rented_end);
        $response->assertOk();
    }
}
