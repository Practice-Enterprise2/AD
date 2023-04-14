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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
<<<<<<< Updated upstream
            $table->string('name'); //$table->foreignID('EmployeeID');
            $table->string('type')->default('Truck');
            $table->string('license_plate')->nullable();
            $table->string('start_location')->nullable();
            $table->string('end_location')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
            $table->bool('deleted')->default(false);
=======
            $table->foreignId('driver_id')->constrained('employees');
            $table->string('type')->default('Truck');
            $table->string('license_plate');
            $table->foreignId('airport_address_id')->constrained('airports'); //
            $table->foreignId('depot_address_id')->constrained('depots'); //
            $table->string('status');
            $table->boolean('deleted')->default(false);
            $table->timestamps();
            
>>>>>>> Stashed changes
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
<<<<<<< Updated upstream
=======

/*<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    /*public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
           $table->foreignID('employees_id')->constrained();
            $table->string('type')->default('Truck');
            $table->string('license_plate');
            $table->foreignId('address_id')->constrained('airports');
            $table->foreignId('address_id')->constrained('depots');
            $table->string('status');
            $table->boolean('deleted')->default(false);
            $table->timestamps();
            
        });
    }*/

    /**
     * Reverse the migrations.
     */
   /* public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
*/
>>>>>>> Stashed changes
