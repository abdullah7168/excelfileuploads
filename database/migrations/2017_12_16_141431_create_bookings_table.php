<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('row_id')->nullable();
            $table->dateTime('start_at')->nullable();
            $table->dateTime('end_at')->nullable();
            $table->string('booked')->nullable();
            $table->string('unavailable')->nullable();
            $table->string('tentative_expires_at')->nullable();
            $table->string('rental')->nullable();
            $table->string('client')->nullable();
            $table->string('initial_price')->nullable();
            $table->string('airbnb_cleaning_fee')->nullable();
            $table->string('booking_com_fee')->nullable();
            $table->string('final_price')->nullable();
            $table->text('notes')->nullable();
            $table->string('adults')->nullable();
            $table->string('children')->nullable();
            $table->string('account')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->string('canceled_at')->nullable();
            $table->string('damage_deposit')->nullable();
            $table->string('currency')->nullable();
            $table->string('source')->nullable();
            $table->string('downpayment')->nullable();
            $table->string('reference')->nullable();
            $table->string('bookings_tags')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop("bookings");
    }
}
