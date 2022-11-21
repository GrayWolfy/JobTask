<?php


namespace App\Http\Middleware;


use App\Models\Car;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RentAble
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

        /** @var Car $car */
        $car = $request->car;
        if ($car->isRented()) {
            return response()->json('Car ' . $car->name . ' is already rented', 401);
        }

        if ($user->rents) {
            return response()->json('You want too much pal', 401);
        }

        return $next($request);
    }
}
