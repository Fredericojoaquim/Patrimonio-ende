<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepreciacaoResidenciaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('depreciacao_residencia', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('residencia_id')->unsigned();
            $table->double('dp_anual')->nullable();
            $table->foreign('residencia_id')->references('id')->on('residencia');
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
        Schema::dropIfExists('depreciacao_residencia');
    }
}
