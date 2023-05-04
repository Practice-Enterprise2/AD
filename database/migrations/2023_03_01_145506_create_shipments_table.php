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
            $table->string('name', 50); // is dropped at update_shipments table
            $table->foreignId('source_address_id')->constrained('addresses');
            $table->foreignId('destination_address_id')->constrained('addresses');
            $table->date('shipment_date');
            $table->date('delivery_date');
            $table->integer('status');
            $table->integer('expense');
            $table->integer('weight');
            $table->string('type', 50); // Fragile, Liquid, Hazardous(Lighter, Battery etc..)
            $table->timestamps();
            // new updates for the shipments table is at "modify_shipments" migration.
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
