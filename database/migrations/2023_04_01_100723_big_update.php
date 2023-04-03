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
        Schema::table('employees', function (Blueprint $table) {
            $table->dropColumn(['firstName', 'lastName', 'phoneNumber', 'mail', 'isActive', 'street', 'province', 'city', 'postalCode', 'password']);
            $table->foreignId('user_id')->after('id')->constrained();
            $table->softDeletes()->after('updated_at');
        });

        Schema::drop('customers');

        Schema::table('airports', function (Blueprint $table) {
            $table->string('iata_code', 3)->after('id');
            $table->softDeletes()->after('updated_at');
        });

        Schema::table('contracts', function (Blueprint $table) {
            $table->dropForeign('contracts_airport_id_foreign');
        });

        Schema::table('contracts', function (Blueprint $table) {
            $table->dropColumn('airport_id');
            $table->dropColumn('depart_location');
            $table->foreignId('depart_airport_id')->after('airline_id')->constrained('airports');
            $table->dropColumn('destination_location');
            $table->foreignId('destination_airport_id')->after('depart_airport_id')->constrained('airports');
            $table->boolean('is_active')->after('price');
        });

        Schema::create('business_customers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('vat_number', 20);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex('users_email_unique');
        });

        Schema::table('roles', function (Blueprint $table) {
            $table->bigIncrements('id')->change();
        });

        Schema::table('role_user', function (Blueprint $table) {
            $table->dropColumn('id');
            $table->unsignedBigInteger('role_id')->change();
            $table->unsignedBigInteger('user_id')->change();
            $table->foreign('role_id')->references('id')->on('roles');
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('shipments', function (Blueprint $table) {
            $table->dropColumn('name');
        });

        Schema::create('positions', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->timestamps();
        });

        Schema::create('employee_contracts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->timestamps();
        });

        Schema::create('position_to_employee_contract', function (Blueprint $table) {
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->foreignId('position_id')->constrained();
            $table->foreignId('employee_contract_id')->constrained();
        });

        Schema::create('holiday_saldos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contract_id')->constrained();
            $table->unsignedInteger('allowed_days');
            $table->year('year');
            $table->set('type', ['holiday', 'sickness']);
            $table->timestamps();
        });

        Schema::create('absences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contract_id')->constrained();
            $table->date('start_date');
            $table->date('end_date');
            $table->set('status', ['taken', 'canceled', 'awaiting_approval', 'approved']);
            $table->dateTimeTz('approval_time');
            $table->set('type', ['holiday', 'sickness']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('absences');

        Schema::drop('holiday_saldos');

        Schema::drop('position_to_employee_contract');

        Schema::drop('employee_contracts');

        Schema::drop('positions');

        Schema::table('shipments', function (Blueprint $table) {
            $table->string('name', 50)->after('id');
        });

        Schema::table('role_user', function (Blueprint $table) {
            $table->dropForeign('role_user_user_id_foreign');
            $table->dropForeign('role_user_role_id_foreign');

            // Here is an explanation of what this does:
            // https://blogs.motiondevelopment.top/blog/posts/laravel-index-explained
            $table->dropIndex('role_user_user_id_foreign');
            $table->dropIndex('role_user_role_id_foreign');
        });

        Schema::table('role_user', function (Blueprint $table) {
            $table->increments('id')->first();
            $table->unsignedInteger('user_id')->change();
            $table->unsignedInteger('role_id')->change();
        });

        Schema::table('roles', function (Blueprint $table) {
            $table->increments('id')->change();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->unique('email');
        });

        Schema::drop('business_customers');

        Schema::table('contracts', function (Blueprint $table) {
            $table->dropForeign('contracts_destination_airport_id_foreign');
            $table->dropForeign('contracts_depart_airport_id_foreign');
        });

        Schema::table('contracts', function (Blueprint $table) {
            $table->dropColumn('is_active');
            $table->dropColumn('destination_airport_id');
            $table->string('destination_location', 50)->after('price');
            $table->dropColumn('depart_airport_id');
            $table->string('depart_location', 50)->after('price');
            $table->foreignId('airport_id')->after('price')->constrained();
        });

        Schema::table('airports', function (Blueprint $table) {
            $table->dropSoftDeletes();
            $table->dropColumn('iata_code');
        });

        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 30);
            $table->string('last_name', 30);
            $table->string('email', 50)->default('')->nullable();
            $table->foreignId('address_id')->nullable()->constrained();
            $table->string('phone_number', 20)->default('')->nullable();
            $table->enum('type', ['individual', 'business']);
            $table->timestamps();
        });

        Schema::table('employees', function (Blueprint $table) {
            // Has to be in a separate connection from deleting the table!
            $table->dropForeign('employees_user_id_foreign');
        });

        Schema::table('employees', function (Blueprint $table) {
            $table->dropSoftDeletes();
            $table->dropColumn('user_id');
            $table->string('firstName', 255)->after('id');
            $table->string('lastName', 255)->after('firstName');
            $table->string('street', 255)->after('lastName');
            $table->string('province', 255)->after('street');
            $table->string('city', 255)->after('province');
            $table->integer('postalCode')->after('city');
            $table->string('phoneNumber', 255)->after('postalCode');
            $table->string('mail', 255)->after('phoneNumber');
            $table->string('isActive', 255)->after('dateOfBirth');
            $table->string('password', 255)->after('Iban');
        });
    }
};
