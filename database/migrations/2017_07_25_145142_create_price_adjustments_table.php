<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePriceAdjustmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price_adjustments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("transaction_id")->unsigned()->index();
            $table->integer("item_id")->unsigned()->index();
            $table->text("before");
            $table->text("after");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('price_adjustments');
    }
}
