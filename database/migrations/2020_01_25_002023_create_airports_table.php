<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateAirportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('airports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('iata_code');
            $table->string('location');
            $table->string('province');
        });

        DB::table('airports')->insert([
            ['province' => 'Buenos Aires', 'location' => 'Ciudad de Buenos Aires', 'name' => 'Jorge Newbery', 'iata_code' => 'AEP'],
            ['province' => 'Buenos Aires', 'location' => 'Ezeiza', 'name' => 'Ministro Pistarini', 'iata_code' => 'EZE'],
            ['province' => 'Buenos Aires', 'location' => 'La Plata', 'name' => 'La Plata', 'iata_code' => 'LPG'],
            ['province' => 'Buenos Aires', 'location' => 'Mar del Plata', 'name' => 'Astor Piazzolla', 'iata_code' => 'MDQ'],
            ['province' => 'Buenos Aires', 'location' => 'Necochea', 'name' => 'Necochea', 'iata_code' => 'NEC'],
            ['province' => 'Cordoba', 'location' => 'Córdoba', 'name' => 'A. Taravella', 'iata_code' => 'COR'],
            ['province' => 'Mendoza', 'location' => 'Mendoza', 'name' => 'El Plumerillo', 'iata_code' => 'MDZ'],
            ['province' => 'Río Negro', 'location' => 'Bariloche', 'name' => 'Tte. Luis Candelaria', 'iata_code' => 'BRC'],
            ['province' => 'Misiones', 'location' => 'Puerto Iguazú', 'name' => 'My. Carlos E. Krause', 'iata_code' => 'IGR'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('airports');
    }
}
