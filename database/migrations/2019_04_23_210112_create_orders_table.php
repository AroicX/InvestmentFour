<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('investor_id', 150);
            $table->integer('investment_id')->unsigned();
            $table->foreign('investment_id')->references('id')->on('investments');
            $table->integer('purchased_slot');
            $table->double('property_cost', 50, 1);
            $table->double('miscellaneous', 50, 1);
            $table->boolean('filled', 1)->default(0);
            $table->string('payment_gateway', 50);
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
        Schema::dropIfExists('orders');
    }
}
