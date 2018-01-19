<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("room_id")->index()->unsigned();
            $table->integer("ammount")->unsigned();
            $table->string("rate")->index();
            $table->string("rateName");
            $table->integer("units")->unsigned();
            $table->timestamp("date")->null();
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
        Schema::dropIfExists('room_payments');
    }
}
