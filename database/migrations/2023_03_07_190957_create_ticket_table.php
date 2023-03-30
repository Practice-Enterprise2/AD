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
            $table->tinyInteger('cstID');
            $table->tinyInteger('employeeID');
            $table->string('issue', 64);
            $table->longText('description');
            $table->longText('solution');
            $table->set('status', ['solved', 'unsolved']);
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
