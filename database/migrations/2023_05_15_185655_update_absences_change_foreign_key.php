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
        Schema::table('absences', function (Blueprint $table) {
            $table->dropForeign(['contract_id']);
            $table->dropColumn('contract_id');
        });

        Schema::table('absences', function (Blueprint $table) {
            $table->foreignId('employee_contract_id')->after('id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('absences', function (Blueprint $table) {
            $table->dropForeign(['employee_contract_id']);
            $table->dropColumn('employee_contract_id');
        });

        Schema::table('absences', function (Blueprint $table) {
            $table->foreignId('contract_id')->after('id')->constrained();
        });
    }
};
