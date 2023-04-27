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
        Schema::table('shipments', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('shipments', function (Blueprint $table) {
            $table->enum('status', [
                'Awaiting Confirmation',
                'Awaiting Pickup',
                'In Transit',
                'Out For Delivery',
                'Delivered',
                'Exception',
                'Held At Location',
                'Deleted',
                'Declined',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('shipments', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('shipments', function (Blueprint $table) {
            $table->enum('status', [
                'Awaiting Confirmation',
                'Awaiting Pickup',
                'In Transit',
                'Out For Delivery',
                'Delivered',
                'Exception',
                'Held At Location',
            ])->after('receiver_email');
        });
    }
};
