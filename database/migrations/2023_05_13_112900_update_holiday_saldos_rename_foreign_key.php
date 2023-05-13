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
        Schema::table('holiday_saldos', function (Blueprint $table) {
            $table->dropForeign(['contract_id']);
            $table->dropColumn('contract_id');
        });

        Schema::table('holiday_saldos', function (Blueprint $table) {
            $table->foreignId('contract_id')->constrained('employee_contracts')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('holiday_saldos', function (Blueprint $table) {
           $table->dropForeign(['contract_id']);
           $table->dropColumn('contract_id');
        });

        Schema::table('holiday_saldos', function (Blueprint $table) {
           $table->foreignId('contract_id')->constrained('contracts')->change();
        });
    }
};