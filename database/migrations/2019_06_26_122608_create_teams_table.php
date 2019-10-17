<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->Increments('id');
            $table->integer('application_id')->unsigned();
            // $table->integer('application_id')->unsigned();
            // $table->integer('team_role_id')->unsigned();
            $table->integer('team_role_id')->unsigned();
            $table->string('image_file', 45);
            $table->string('name', 45);
            $table->string('position', 150);
            $table->string('facebook_link');
            $table->string('twitter_link');
            $table->string('discord_link');
            $table->string('instagram-_ink');
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
        Schema::dropIfExists('teams');
    }
}
