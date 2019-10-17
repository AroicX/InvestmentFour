<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kin_id', 150);
            $table->string('investor_id', 150);
            $table->string('full_name', 45);
            $table->string('email', 150);
            $table->string('phone', 10);
            $table->string('address', 150);
            $table->string('country', 45);
            $table->string('relationship', 15);
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
        Schema::dropIfExists('kins');
    }
}
