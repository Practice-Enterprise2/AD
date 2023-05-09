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
        Schema::table('waypoints', function (Blueprint $table) {
            $table->dropColumn('status');
        });
        Schema::table('waypoints', function (Blueprint $table) {
            $table->enum('status', [
                'Awaiting Action', //04/25/23
                'Received', //04/25/23
                'Out For Client', // 05/03/23
                'In Transit',
                'Out For Delivery',
                'Delivered',
                'Exception',
            ])->after('next_address_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('waypoints', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('waypoints', function (Blueprint $table) {
            $table->enum('status', [
                'In Transit',
                'Out For Delivery',
                'Delivered',
                'Exception',
            ])->after('next_address_id');
        });
    }
};
