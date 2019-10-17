<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_responses', function (Blueprint $table) {
            $table->Increments('id');
            $table->integer('ticket_message_id')->unsigned();
            $table->foreign('ticket_message_id')->references('id')->on('ticket_messages')->onDelete('cascade');
            $table->string('responder_id', 150);
            $table->text('message');
            $table->boolean('read', 1)->default(0);
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
        Schema::dropIfExists('ticket_responses');
    }
}
