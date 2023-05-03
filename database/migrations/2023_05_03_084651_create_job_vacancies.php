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
        Schema::create('job_vacancies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('department');
            $table->text('description');
            $table->boolean('filled')->default(false);
            $table->timestamps();
        });

        Schema::create('applied_people', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_vacancies_id')->constrained();
            $table->string('name');
            $table->string('contact_info');
            $table->binary('cv');
            $table->timestamp('application_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applied_people');
        Schema::dropIfExists('job_vacancies');
    }
};
