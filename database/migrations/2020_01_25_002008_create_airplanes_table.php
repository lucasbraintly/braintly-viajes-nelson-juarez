<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateAirplanesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('airplanes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('airline_id');
            $table->string('model');
            $table->unsignedInteger('economy_class_seats');
            $table->unsignedInteger('first_class_seats');

            $table->foreign('airline_id')->references('id')->on('airlines');
        });

        DB::table('airplanes')->insert([
            ['airline_id' => 1, 'model' => '737-800', 'first_class_seats' => '20', 'economy_class_seats' => '106'],
            ['airline_id' => 1, 'model' => '737-800', 'first_class_seats' => '20', 'economy_class_seats' => '106'],
            ['airline_id' => 1, 'model' => '737-800', 'first_class_seats' => '16', 'economy_class_seats' => '100'],
            ['airline_id' => 1, 'model' => 'Airbus A321', 'first_class_seats' => '0', 'economy_class_seats' => '235'],
            ['airline_id' => 1, 'model' => 'Airbus A321', 'first_class_seats' => '0', 'economy_class_seats' => '235'],
            ['airline_id' => 2, 'model' => '737-800', 'first_class_seats' => '20', 'economy_class_seats' => '110'],
            ['airline_id' => 2, 'model' => '737-800', 'first_class_seats' => '16', 'economy_class_seats' => '100'],
            ['airline_id' => 3, 'model' => 'Airbus A321', 'first_class_seats' => '0', 'economy_class_seats' => '186'],
            ['airline_id' => 3, 'model' => 'Airbus A321', 'first_class_seats' => '0', 'economy_class_seats' => '186'],
            ['airline_id' => 3, 'model' => 'Airbus A321', 'first_class_seats' => '0', 'economy_class_seats' => '186'],
            ['airline_id' => 3, 'model' => 'Airbus A321', 'first_class_seats' => '0', 'economy_class_seats' => '186'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('airplanes');
    }
}
