<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemVariablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_variables', function (Blueprint $table) {
           $table->integer('item_id')->unsigned();
           $table->integer("quantity")->default(0);
           $table->primary("item_id");
           $table->float("buyingPrice",10,1);
           $table->float("sellingPrice",10,1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_variables');
    }
}
