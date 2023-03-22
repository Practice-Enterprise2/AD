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
        Schema::create('pickups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('street', 100);
            $table->string('house_number', 30);
            $table->string('postal_code', 40);
            $table->string('city', 200);
            $table->string('region', 200);
            $table->string('country', 200);
            $table->dateTimeTz('time');
            $table->enum('status', ['pending', 'completed', 'canceled'])->default('pending');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pickups');
    }
};
