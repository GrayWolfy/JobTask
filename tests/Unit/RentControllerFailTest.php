<?php

use App\Models\Car;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\CreatesApplication;
use Tests\TestCase;

class RentControllerFailTest extends TestCase
{
    use CreatesApplication, DatabaseMigrations;

    public function testRentNotFound()
    {
        $this->createAuthenticatedUser();

        $response = $this->getJson('api/car/rent/' . 98);

        $response->assertNotFound();
    }

    public function testRentCarIsRented()
    {
        $this->createAuthenticatedUser();

        /** @var Car $car */
        $car = Car::factory()->create(['rented' => 1]);

        $response = $this->getJson('api/car/rent/' . $car->id);

        $response->assertUnauthorized();
    }

    public function testRentUserAlreadyRented()
    {
        $this->createAuthenticatedUser();

        /** @var Car $car */
        $car = Car::factory()->create();

        /** @var Car $testCar */
        $testCar = Car::factory()->create();

        $this->getJson('api/car/rent/' . $car->id);
        $this->getJson('api/car/rent/' . $testCar->id)->assertUnauthorized();
    }

    public function testFinishRentNotFound()
    {
        $this->createAuthenticatedUser();

        /** @var Car $car */
        $car = Car::factory()->create();

        $this->getJson('api/car/rent/' . $car->id);

        $response = $this->getJson('api/car/finishRent/' . 98);

        $response->assertNotFound();
    }

    public function testFinishRentUserNotRented()
    {
        $this->createAuthenticatedUser();

        /** @var Car $car */
        $car = Car::factory()->create(['rented' => 1]);

        $response = $this->getJson('api/car/finishRent/' . $car->id);

        $response->assertUnauthorized();
    }

    public function testFinishRentNotTheRentedCar()
    {
        $this->createAuthenticatedUser();

        /** @var Car $car */
        $car = Car::factory()->create();

        /** @var Car $testCar */
        $testCar = Car::factory()->create();

        $this->getJson('api/car/rent/' . $car->id);

        $response = $this->getJson('api/car/finishRent/' . $testCar->id);

        $response->assertUnauthorized();
    }
}
