<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateFlightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flights', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('airline_id');
            $table->unsignedBigInteger('departure_airport_id');
            $table->dateTime('departure_date');
            $table->unsignedBigInteger('arrival_airport_id');
            $table->dateTime('arrival_date');
            $table->unsignedBigInteger('airplane_id');
            $table->unsignedInteger('duration');
            $table->float('base_price');
            $table->enum('status', ['scheduled', 'finished', 'flying', 'cancelled'])->default('scheduled');
            $table->timestamps();
        });

        DB::table('flights')->insert([
            [
                'airline_id' => 1,
                'departure_airport_id' => 2,
                'departure_date' => now(),
                'arrival_airport_id' => 7,
                'arrival_date' => now()->addMinutes(130),
                'airplane_id' => 1,
                'duration' => 130,
                'base_price' => 2000,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'airline_id' => 1,
                'departure_airport_id' => 2,
                'departure_date' => now(),
                'arrival_airport_id' => 4,
                'arrival_date' => now()->addMinutes(130),
                'airplane_id' => 1,
                'duration' => 130,
                'base_price' => 2000,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('flights');
    }
}
