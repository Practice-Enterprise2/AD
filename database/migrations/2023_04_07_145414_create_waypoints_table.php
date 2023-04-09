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
        Schema::create('waypoints', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shipment_id')->constrained('shipments');
            $table->foreignId('current_address_id')->constrained('addresses');
            $table->foreignId('next_address_id')->constrained('addresses');
            $table->enum('status', [
                'In Transit',
                'Out For Delivery',
                'Delivered',
                'Exception',
            ]); // 'In Transit', 'Out For Delivery', 'Delivered', 'Exception'
            //$table->string('employee_notes'); //can be implemented later on.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('waypoints');
    }
};
