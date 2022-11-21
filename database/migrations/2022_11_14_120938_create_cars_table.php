<?php

use App\Models\Car;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable(true)->constrained('users');
            $table->string('name');
            $table->string('auto_number');
            $table->tinyInteger('rented')->nullable();
            $table->dateTime('rented_begin')->nullable();
            $table->dateTime('rented_end')->nullable();
            $table->timestamps();
        });

        $cars = [
            'Lada' => '234235325235',
            'Toyota' => '23532236634',
            'Maserati' => '8435887358237',
            'Hyundai' => '4358934753220',
        ];

        foreach ($cars as $name => $number) {
            $car = new Car();
            $car->name = $name;
            $car->auto_number = $number;
            $car->rented = 0;
            $car->save();
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cars');
    }
};
