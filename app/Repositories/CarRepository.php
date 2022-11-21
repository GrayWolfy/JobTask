<?php


namespace App\Repositories;


use App\Models\Car;
use Illuminate\Database\Eloquent\Collection;

class CarRepository
{
    public function notRented(): array|Collection|\Illuminate\Support\Collection
    {
        return Car::where('rented', '=', false)->orderBy('id')->get();
    }
}
