<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertyUploadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_uploads', function (Blueprint $table) {
            $table->increments('id');
            $table->string('property_type');
            $table->string('property_region');
            $table->boolean('rentage', 1)->default(0);
            $table->string('title', 45);
            $table->integer('bedroom');
            $table->integer('bathroom');
            $table->integer('toilet');
            $table->string('note', 45);
            $table->string('address', 150);
            $table->string('country', 45);
            $table->string('state', 45);
            $table->string('city');
            $table->double('cost', 50, 1);
            $table->boolean('active', 1)->default(0);
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
        Schema::dropIfExists('property_uploads');
    }
}
