<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOnRentagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('on_rentages', function (Blueprint $table) {
            $table->Increments('id');
            $table->integer('investment_id')->unsigned();
            $table->foreign('investment_id')->references('id')->on('investments');
            $table->integer('payment_count')->comment('Holds the number of times an investor is to be paid');
            $table->boolean('active', 1)->default(1);
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
        Schema::dropIfExists('on_rentages');
    }
}
