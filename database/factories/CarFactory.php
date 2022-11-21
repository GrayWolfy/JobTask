<?php


namespace Database\Factories;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => 'Volvo',
            'auto_number' => '2752563250273',
            'rented' => false,
            'rented_begin' => null,
            'rented_end' => null,
            'created_at' => Carbon::now(),
        ];
    }
}
