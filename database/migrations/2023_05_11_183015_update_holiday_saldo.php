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
            $table->foreignId('employee_contract_id')->constrained()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('holiday_saldos', function (Blueprint $table) {
            $table->foreignId('employee_contract_id')->change();
        });
    }
};
