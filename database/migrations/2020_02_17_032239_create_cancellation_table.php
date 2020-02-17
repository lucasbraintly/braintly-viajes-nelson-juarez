<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCancellationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cancellation', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('idReservation');
            $table->decimal('montoDevuelto', 10, 2);
            $table->dateTime('fechaCancelacion');

            $table->foreign('idReservation')
                    ->references('id')
                    ->on('reservation')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cancellation');
    }
}
