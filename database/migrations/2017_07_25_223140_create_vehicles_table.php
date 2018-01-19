<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->increments('vehicle_id');
            $table->string("numberPlate")->unique()->index();
            $table->string("owner");
            $table->string("phoneNumber");
            $table->integer("category")->unsigned();
            $table->integer("fee")->unsigned();
            $table->string("icon");
            $table->integer("accountBalance")->default(0);
            $table->string("national_id")->nullable();
            
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
        Schema::dropIfExists('vehicles');
    }
}
