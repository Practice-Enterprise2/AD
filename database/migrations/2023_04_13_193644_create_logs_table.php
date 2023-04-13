<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogsTable extends Migration
{
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->string('session_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamp('date')->useCurrent();
            $table->string('path');
        });
    }

    public function down()
    {
        Schema::dropIfExists('logs');
    }
}
