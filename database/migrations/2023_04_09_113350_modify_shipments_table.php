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
            // nullable to prevent breaking existing code.
            $table->string('receiver_name')->nullable();
            $table->string('receiver_email')->nullable();
            // Requires drop and recreation as there is a bug with changing the
            // type of a column to enum in DBAL.
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
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('shipments', function (Blueprint $table) {
            $table->dropColumn([
                'receiver_name',
                'receiver_email',
                'status',
            ]);
        });
        Schema::table('shipments', function (Blueprint $table) {
            $table->integer('status')->after('delivery_date');
        });
    }
};
