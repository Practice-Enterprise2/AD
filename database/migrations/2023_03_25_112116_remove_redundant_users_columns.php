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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['address', 'postalcode', 'city', 'country']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('address', 255)->after('phone')->nullable();
            $table->string('postalcode', 255)->after('address')->nullable();
            $table->string('city', 255)->after('postalcode')->nullable();
            $table->string('country', 255)->after('city')->nullable();
        });
    }
};
