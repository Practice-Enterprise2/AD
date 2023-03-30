<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('firstName');
            $table->string('lastName');
            $table->string('street');
            $table->string('province');
            $table->string('city');
            $table->integer('postalCode');
            $table->string('phoneNumber');
            $table->string('mail');
            $table->date('dateOfBirth');
            $table->string('isActive');
            $table->string('jobTitle');
            $table->integer('salary');
            $table->string('Iban');
            $table->string('password');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
};
