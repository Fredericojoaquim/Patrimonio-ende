<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbateMaterialeletronicoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abate_materialeletronico', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('materialeletronico_id');
            $table->bigInteger('motivoAbate_id');
            $table->date('dataAbate');
            $table->foreign('materialeletronico_id')->references('id')->on('materiaeletronico');
            $table->foreign('motivoAbate_id')->references('id')->on('motivos_abate');
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
        Schema::dropIfExists('abate_materialeletronico');
    }
}
