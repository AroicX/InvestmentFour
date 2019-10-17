<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvestorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investors', function (Blueprint $table) {
            $table -> increments('id');
            $table -> string('ip_addr', 20);
            $table -> string('investor_id', 150);
            $table -> string('first_name', 15) -> nullable();
            $table -> string('last_name', 15) -> nullable();
            $table -> string('email', 150) -> unique('email');
            $table -> string('password', 150);
            $table -> rememberToken();
            $table -> string('token', 100);
            $table -> string('phone', 10) -> unique('phone');
            $table -> string('address', 150) -> nullable();
            $table -> string('country', 45) -> nullable();
            $table -> string('state', 45) -> nullable();
            $table -> string('city', 45) -> nullable();
            $table -> boolean('terms', 1) -> default(1);
            $table -> boolean('active', 1)->default(0);
            $table -> boolean('twoFA') -> default(1);
            $table -> boolean('twoFA_verified', 1)->default(0);
            $table -> timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('investors');
    }
}
