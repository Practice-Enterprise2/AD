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
        Schema::create('permission_grants_permission', function (Blueprint $table) {
            $table->primary(['main_permission_id', 'granted_permission_id']);
            $table->foreignId('main_permission_id')->constrained('permissions');
            $table->foreignId('granted_permission_id')->constrained('permissions');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('permission_grants_permission');
    }
};
