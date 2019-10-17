<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRentPayOffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rent_pay_offs', function (Blueprint $table) {
            $table->Increments('id');
            $table->integer('on_rentage_id')->unsigned();
            $table->foreign('on_rentage_id')->references('id')->on('on_rentages');
            $table->string('investor_id', 150);
            $table->date('first_payment_date');
            $table->date('next_payment_date');
            $table->date('last_payment_date');
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
        Schema::dropIfExists('rent_pay_offs');
    }
}
