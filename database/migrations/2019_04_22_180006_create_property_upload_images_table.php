<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertyUploadImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_upload_images', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('property_upload_id')->unsigned();
            $table->foreign('property_upload_id')->references('id')->on('property_uploads')->onDelete('cascade');
            $table->string('front_image');
            $table->string('side_image');
            $table->string('back_image');
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
        Schema::dropIfExists('property_upload_images');
    }
}
