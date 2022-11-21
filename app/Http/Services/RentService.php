<?php


namespace App\Http\Services;


use App\Models\Car;
use App\Models\User;
use Illuminate\Support\Carbon;

class RentService
{
    public function rent(Car $car, User $user): void
    {
        $car->rented = true;
        $car->rented_begin = Carbon::now();
        $car->user_id = $user->id;
        $car->save();

        $user->rents = true;
        $user->save();
    }

    public function finishRent(Car $car, User $user): void
    {
        $car->rented = false;
        $car->user_id = null;
        $car->rented_end = Carbon::now();
        $car->save();

        $user->rents = false;
        $user->save();
    }
}
