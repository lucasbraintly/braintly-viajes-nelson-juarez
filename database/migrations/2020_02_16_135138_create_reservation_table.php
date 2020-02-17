<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservation', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('idFlight');
            $table->string('name');
            $table->string('surname');
            $table->string('email');
            $table->decimal('price', 10, 2);
            $table->enum('class_seats', ['economy', 'first'])->default('economy');
            $table->dateTime('fechaReserva');
            $table->enum('status', ['reserved ', 'cancelled'])->default('reserved');
            
            $table->foreign('idFlight')
                    ->references('id')
                    ->on('flights')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservation');
    }
}
