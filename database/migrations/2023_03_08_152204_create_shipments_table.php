<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->string('from_name');
            $table->string('from_phone');
            $table->string('from_address');
            $table->string('from_postalcode');
            $table->string('from_city');
            $table->string('from_country');
            $table->string('to_name');
            $table->string('to_phone');
            $table->string('to_address');
            $table->string('to_postalcode');
            $table->string('to_city');
            $table->string('to_country');
            $table->integer('weight');
            $table->integer('package_num');
            $table->tinyInteger('status')->default(0);
            $table->unsignedFloat('price');
            $table->foreign('customer_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipments');
    }
};
