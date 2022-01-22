<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class OrderList extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_list', function (Blueprint $table) {
            $table->id();
            $table->string('order_id');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->integer('country');
            $table->tinyInteger('direction');
            $table->integer('airport');
            $table->integer('destination');
            $table->integer('passenger_quantity');
            $table->integer('baby_seat');
            $table->string('vehicle');
            $table->timestamp('flight_date')->nullable();
            $table->string('flight_no');
            $table->integer('terminal');
            $table->timestamp('transfer_date')->nullable();
            $table->string('transfer_point');
            $table->string('transfer_notes');
            $table->timestamp('return_flight_date')->nullable();
            $table->timestamp('return_transfer_date')->nullable();
            $table->string('return_flight_no')->nullable();
            $table->integer('return_terminal')->nullable();
            $table->string('pickup_point')->nullable();
            $table->string('return_transfer_notes')->nullable();
            $table->float('original_price');
            $table->string('converted_price');
            $table->string('lang');
            $table->string('currency');
            $table->boolean('email_list_agreed');
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
        Schema::dropIfExists('order_list');
    }
}
