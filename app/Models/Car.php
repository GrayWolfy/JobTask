<?php

namespace App\Models;

use App\Repositories\CarRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Car
 *
 * @package App\Models
 * @property string $name
 * @property string $auto_number
 * @property boolean $rented
 * @property Carbon $rented_begin
 * @property Carbon $rented_end
 * @property int $id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @mixin \Eloquent
 */
class Car extends Model
{
    use HasFactory;

    public static function notRented(CarRepository $repository): Collection|array
    {
        return $repository->notRented();
    }

    public function isRented(): bool
    {
        return $this->rented;
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
