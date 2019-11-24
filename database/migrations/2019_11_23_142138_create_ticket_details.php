<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('trainId');
            $table->float('price', 5,2);
            $table->integer('noOfPassengers');
            $table->float('amount', 10,2);
            $table->string('contactName');
            $table->string('contactEmail');
            $table->string('contactPhone');
            $table->string('contactAddress');
            $table->integer('pnr')->nullable();
            $table->string('status')->default('unpaid');
            $table->string('paymentMethod');
            $table->longText('paymentNotes');
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
        Schema::dropIfExists('ticket_details');
    }
}
