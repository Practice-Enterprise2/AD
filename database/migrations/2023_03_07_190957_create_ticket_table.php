<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('ticketID')->unique();
            $table->string('name');
            $table->string('email', 255);
            $table->tinyInteger('employeeID')->nullable();
            $table->string('issue', 64);
            $table->longText('description');
            $table->longText('solution')->nullable();
            $table->set('status', ['solved', 'unsolved'])->default('unsolved');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};