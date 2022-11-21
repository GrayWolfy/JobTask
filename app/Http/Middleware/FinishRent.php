<?php


namespace App\Http\Middleware;


use App\Models\Car;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FinishRent
{
    /**
     * Обработка входящего запроса.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if (!$user->rents) {
            return response()->json('You dont have any rents', 401);
        }

        /** @var Car $car */
        $car = $request->car;

        if (!$car->isRented() || $car->user_id !== $user->id) {
            return response()->json('This is not the car you have rented', 401);
        }

        return $next($request);
    }
}
