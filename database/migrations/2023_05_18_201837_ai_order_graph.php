<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AiOrderGraph extends Migration
{
    public function up()
    {
        Schema::create('ai_order_graph', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->integer('ordercount');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ai_order_graph');
    }
}
