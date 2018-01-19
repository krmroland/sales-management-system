<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehiclePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_payments', function (Blueprint $table) {
           $table->increments('id');
           $table->integer("vehicle_id")->unsigned()->index();
           $table->timestamp("date")->nullable();
           $table->integer("balanceBefore");
           $table->integer("paid");
           $table->integer("fee");
           $table->integer("balanceAfter");
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
        Schema::dropIfExists('vehicle_payments');
    }
}
