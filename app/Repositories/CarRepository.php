<?php


namespace App\Repositories;


use App\Models\Car;

class CarRepository
{
    public function notRented(): array
    {
        return Car::where('rented', '=', false)->orderBy('id')->get()->toArray();
    }
}
