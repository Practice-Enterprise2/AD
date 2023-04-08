<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            // $table->string('name', 50);
            $table->foreignId('source_address_id')->constrained('addresses');
            $table->foreignId('destination_address_id')->constrained('addresses');
            $table->date('shipment_date')->default(date('Y-m-d'));
            $table->date('delivery_date')->default(date('Y-m-d'));

            // integer value for status ?????.......
            $table->string('status')->default('Awaiting Confirmation'); // Awaiting Confirmation, Awaiting Pickup, In Transit, Out For Delivery, Delivered, Exception, Held At Location;
            $table->integer('expense')->default(0);
            $table->integer('weight')->default(0);
            // $table->string('type', 50);

            $table->foreignId('sender_id');
            // $table->foreignId('source_address_id');
            // $table->foreignId('destination_address_id');
            $table->string('receiver_name');
            $table->string('receiver_email');
            $table->string('handling_type'); // Fragile, Liquid, Hazardous(Lighter, Battery etc..)
            // $table->string('status')->default('Awaiting Confirmation'); // Awaiting Confirmation, Awaiting Pickup, In Transit, Out For Delivery, Delivered, Exception, Held At Location

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
        Schema::dropIfExists('shipments');
    }
};
