<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvestmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('property_upload_id')->unsigned();
            $table->foreign('property_upload_id')->references('id')->on('property_uploads')->onDelete('cascade');
            $table->integer('investment_duration');
            $table->integer('slots');
            $table->integer('avail_slots');
            $table->double('renovation_cost', 50, 1);
            $table->double('management_cost', 50, 1);
            $table->double('cost_per_slot', 50, 1);
            $table->double('profit_per_slot_on_rent', 50, 1);
            $table->double('total_profit_per_slot_on_rent', 50, 1);
            $table->double('profit_per_slot_on_sell_off', 50, 1);
            $table->double('total_profit_per_slot_on_sell_off', 50, 1);
            $table->boolean('active')->default(1);
            $table->boolean('filled')->default(0);
            $table->boolean('running')->default(0);
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
        Schema::dropIfExists('investments');
    }
}
