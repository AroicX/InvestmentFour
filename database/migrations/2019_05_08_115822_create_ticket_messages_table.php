<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_messages', function (Blueprint $table) {
            $table->Increments('id');
            $table->integer('ticket_subject_id')->unsigned();
            $table->foreign('ticket_subject_id')->references('id')->on('ticket_subjects');
            $table->string('investor_id', 150);
            $table->text('message');
            $table->boolean('satisfied', 1)->default(0);
            $table->boolean('deleted', 1)->default(0);
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
        Schema::dropIfExists('ticket_messages');
    }
}
