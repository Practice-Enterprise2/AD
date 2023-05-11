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
            $table->foreign('contract_id')
            ->references('id')->on('employee_contracts')->constraint()->change();
        });
        Schema::table('absences', function (Blueprint $table){
            $table->dropForeign(['contract_id']);
            $table->foreign('contract_id')
            ->references('id')->on('employee_contracts')->constraint()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('holiday_saldos', function (Blueprint $table) {
            $table->foreignId('contract_id')->change();
        });
        Schema::table('absences', function (Blueprint $table) {
            $table->foreignId('contract_id')->change();
        });
    }
};

