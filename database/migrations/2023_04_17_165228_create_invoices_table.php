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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shipment_id')->constrained('shipments');
            $table->integer('weight'); // Is the weight
            $table->date('due_date');
            $table->float('total_price');
            $table->float('total_price_excl_vat');
            $table->boolean('is_paid')->default(0)->change();
            $table->timestamps();
            $table->string('invoice_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices', function (Blueprint $table) {
            $table->dropForeign(['shipment_id']);
            $table->dropColumn([
                'shipment_id',
            ]);
        });
    }
};
